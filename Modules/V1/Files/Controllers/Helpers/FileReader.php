<?php

namespace Modules\V1\Files\Controllers\Helpers;

use Illuminate\Support\Facades\Cache;
use Modules\V1\Files\Models\Constants\FileCacheKeys;
use Modules\V1\Files\Models\File;
use Modules\V1\Files\Services\Contracts\UploadInterface;

final class FileReader
{
    private const CHUNK = 100;

    /**
     * @param File $file
     *
     * @return array
     */
    public static function convertCsvDataToArrayChunkByChunk(File $file): array
    {
        $uploaderService = app(UploadInterface::class);
        $data = array_map('str_getcsv', file($uploaderService->getFilePath($file)));
        $headers = array_shift($data);
        $headers = self::mapHeader($headers);

        $result = [];
        foreach ($data as $value) {
            $result[] = array_combine($headers, $value);
        }

        $employeeDuplicateIdWithCount = array_count_values(array_column($result, 'employee_id'));

        $employeeDuplicateIdWithCount = array_filter($employeeDuplicateIdWithCount, function ($count) {
            return $count > 1;
        });

        Cache::remember(
            self::generateFileCacheKey($file->id),
            FileCacheKeys::CURRENT_FILE_EMPLOYEE_DUPLICATE_IDS_TTL,
            static function () use ($employeeDuplicateIdWithCount) {
                return $employeeDuplicateIdWithCount;
            }
        );

        return array_chunk($result, self::CHUNK);
    }

    /**
     * @param array $headers
     *
     * @return array
     */
    private static function mapHeader(array $headers): array
    {
        $keyMappings = [
            'id' => 'id',
            'Emp ID' => 'employee_id',
            'Name Prefix' => 'name_prefix',
            'First Name' => 'first_name',
            'Middle Initial' => 'middle_initial',
            'Last Name' => 'last_name',
            'Gender' => 'gender',
            'E Mail' => 'email',
            'Date of Birth' => 'date_of_birth',
            'Time of Birth' => 'time_of_birth',
            'Age in Yrs.' => 'age_in_yrs',
            'Date of Joining' => 'date_of_joining',
            'Age in Company (Years)' => 'age_in_company',
            'Phone No. ' => 'phone_number',
            'Place Name' => 'place_name',
            'County' => 'country',
            'City' => 'city',
            'Zip' => 'zip',
            'Region' => 'region',
            'User Name' => 'user_name',
        ];

        return array_map(function ($value) use ($keyMappings) {
            return $keyMappings[$value] ?? $value;
        }, $headers);
    }

    /**
     * @param string $fileId
     *
     * @return string
     */
    private static function generateFileCacheKey(string $fileId): string
    {
        return sprintf(FileCacheKeys::CURRENT_FILE_EMPLOYEE_DUPLICATE_IDS_CACHE_KEY.'%s', $fileId);
    }
}
