<?php
use App\Models\UserWebform;
use App\Models\Projects;
use Illuminate\Http\UploadedFile;

if (!function_exists('getCurrentUserWebForms')) {
    function getCurrentUserWebForms($id) {
        $uniqueUserWebforms = UserWebform::join('webforms', 'user_webforms.webform_id', '=', 'webforms.id')
            ->select('user_webforms.webform_id','webforms.*') 
            ->distinct()
            ->where('user_webforms.user_id', $id) 
            ->get();
        return  $uniqueUserWebforms;
    }
}

if (!function_exists('allowed_upload_extension')) {
    function allowed_upload_extension(?string $claimedType, array $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp']): ?string
    {
        $type = strtolower((string) $claimedType);
        if ($type === '' || preg_match('/[^a-z0-9]/', $type)) {
            return null;
        }
        $type = preg_replace('/[^a-z0-9]/', '', $type) ?? '';
        $map = [
            'jpeg' => 'jpg',
            'jpg' => 'jpg',
            'png' => 'png',
            'gif' => 'gif',
            'webp' => 'webp',
            'pdf' => 'pdf',
        ];
        if (!isset($map[$type])) {
            return null;
        }
        $ext = $map[$type];
        $normalized = [];
        foreach ($allowed as $item) {
            $item = strtolower($item);
            $normalized[] = $item === 'jpeg' ? 'jpg' : $item;
        }
        return in_array($ext, $normalized, true) ? $ext : null;
    }
}

if (!function_exists('store_base64_upload')) {
    function store_base64_upload(?string $dataUri, string $folderPath, string $publicPrefix, array $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp']): ?array
    {
        if (!is_string($dataUri) || $dataUri === '' || !str_contains($dataUri, ';base64,')) {
            return null;
        }
        $parts = explode(';base64,', $dataUri, 2);
        if (count($parts) < 2) {
            return null;
        }
        $claimed = $parts[0];
        if (str_contains($claimed, '/')) {
            $claimed = substr($claimed, strrpos($claimed, '/') + 1);
        }
        $claimed = explode(';', $claimed)[0];
        $ext = allowed_upload_extension($claimed, $allowed);
        if ($ext === null) {
            return null;
        }
        $binary = base64_decode($parts[1], true);
        if ($binary === false || $binary === '') {
            return null;
        }
        if (strlen($binary) > 10 * 1024 * 1024) {
            return null;
        }
        if ($ext !== 'pdf' && @getimagesizefromstring($binary) === false) {
            return null;
        }
        if (!is_dir($folderPath)) {
            @mkdir($folderPath, 0755, true);
        }
        $uniqid = uniqid();
        $filename = $uniqid . '.' . $ext;
        $fullPath = rtrim($folderPath, '/\\') . DIRECTORY_SEPARATOR . $filename;
        if (file_put_contents($fullPath, $binary) === false) {
            return null;
        }
        return [
            'public' => rtrim($publicPrefix, '/') . '/' . $filename,
            'ext' => $ext,
        ];
    }
}

if (!function_exists('store_uploaded_file_safe')) {
    function store_uploaded_file_safe($file, string $folderPath, string $publicPrefix, array $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp']): ?array
    {
        if (!$file instanceof UploadedFile || !$file->isValid()) {
            return null;
        }
        $ext = allowed_upload_extension($file->guessExtension() ?: $file->getClientOriginalExtension(), $allowed);
        if ($ext === null) {
            return null;
        }
        if ($file->getSize() > 10 * 1024 * 1024) {
            return null;
        }
        if ($ext !== 'pdf' && @getimagesize($file->getRealPath()) === false) {
            return null;
        }
        if (!is_dir($folderPath)) {
            @mkdir($folderPath, 0755, true);
        }
        $filename = uniqid() . '.' . $ext;
        $file->move($folderPath, $filename);
        return [
            'public' => rtrim($publicPrefix, '/') . '/' . $filename,
            'name' => $filename,
            'ext' => $ext,
        ];
    }
}

if (!function_exists('admin_user_can_access_project')) {
    function admin_user_can_access_project($projectId, $userId = null): bool
    {
        $userId = $userId ?? auth()->id();
        if (!$userId || !$projectId) {
            return false;
        }
        return Projects::query()
            ->join('user_projects', 'projects.id', '=', 'user_projects.project_id')
            ->where('user_projects.user_id', $userId)
            ->where('projects.id', $projectId)
            ->exists();
    }
}