<?php

namespace App\Utils;

use Google\Cloud\Storage\StorageClient;

class GoogleCloudUtil
{
    public $storage;
    public $bucket;
    public $storageBucketName;

    public function __construct()
    {
        $keyfile = [
            'type' => env('GOOGLE_CLOUD_ACCOUNT_TYPE'),
            'private_key_id' => env('GOOGLE_CLOUD_PRIVATE_KEY_ID'),
            'private_key' => env('GOOGLE_CLOUD_PRIVATE_KEY'),
            'client_email' => env('GOOGLE_CLOUD_CLIENT_EMAIL'),
            'client_id' => env('GOOGLE_CLOUD_CLIENT_ID'),
            'auth_uri' => env('GOOGLE_CLOUD_AUTH_URI'),
            'token_uri' => env('GOOGLE_CLOUD_TOKEN_URI'),
            'auth_provider_x509_cert_url' => env('GOOGLE_CLOUD_AUTH_PROVIDER_CERT_URL'),
            'client_x509_cert_url' => env('GOOGLE_CLOUD_CLIENT_CERT_URL'),
        ];

        $this->storage = new StorageClient([
            'projectId' => env('GOOGLE_CLOUD_PROJECT_ID'),
            'keyFile' => $keyfile
        ]);
        $this->bucket = $this->storage->bucket('design_images_bucket');
        $this->storageBucketName = 'design_images_bucket';
    }

    public function uploadImage($pathFile, $folder)
    {
        $fileName = basename($pathFile);
        $fileSource = fopen($pathFile, 'r');
        $googleCloudStoragePath = $folder . '/' . $fileName;
        $this->bucket->upload($fileSource, [
            'name' => $googleCloudStoragePath
        ]);
        $url = 'https://storage.googleapis.com/' . $this->storageBucketName . '/' . $googleCloudStoragePath;
        return $url;
    }

    public function rename($newName, $url)
    {
        $pathBucket = 'https://storage.googleapis.com/' . $this->storageBucketName;
        $pathGcs = substr($url, strlen($pathBucket) + 1);
        $arraySplit = explode('/', $pathGcs);
        $object = $this->bucket->object($pathGcs);
        $pathRename = $arraySplit[0] . '/' . $arraySplit[1] . '/' . $newName;
        $object->rename($pathRename);
        $url = $pathBucket . '/' . $pathRename;
        return $url;
    }

    public function download($pathFile, $folder)
    {
        $object = $this->bucket->object($pathFile);
        if ($object->exists()) {
            $object->downloadToFile($folder);
        }
    }
}
