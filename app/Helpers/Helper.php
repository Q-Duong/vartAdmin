<?php
if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        $format = explode("/", $date);
        $day = array_shift($format);
        $year = array_pop($format);
        $month = implode(" ", $format);
        $dateFormat = $year . "-" . $month . "-" . $day;
        return $dateFormat;
    }
}

if (!function_exists('formatPrice')) {
    function formatPrice($price)
    {
        $str_price_format = Str::replace([' ', '₫', '.'], '', $price);
        return $str_price_format;
    }
}

if (!function_exists('versionResource')) {
    function versionResource($path)
    {
        return  asset($path . "?v=" . config("app.resourceVersion"));
    }
}

if (!function_exists('saveImageSource')) {
    function saveImageSource($folder, $image)
    {
        $path = public_path('storeimages/' . $folder . '/');
        $get_name_image = $image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image =  $name_image . rand(0, 99) . '.' . $image->getClientOriginalExtension();
        $image->move($path, $new_image);
        return $new_image;
    }
}

if (!function_exists('removeImageSource')) {
    function removeImageSource($folder, $name)
    {
        unlink(public_path('storeimages/' . $folder . '/') . $name);
    }
}

if (!function_exists('saveImageFileDrive')) {
    function saveImageFileDrive($file)
    {
        $fileData = File::get($file);
        $get_name_file = $file->getClientOriginalName();
        $name_file = current(explode('.', $get_name_file));
        $new_file =  $name_file . rand(0, 99) . '.' . $file->getClientOriginalExtension();
        Storage::cloud()->put($new_file, $fileData);
        $content = collect(Storage::cloud()->listContents());
        $file_path = $content->where('name', '=', $new_file)->first();
        return $file_path['path'];
    }
}

if (!function_exists('deleteImageFileDrive')) {
    function deleteImageFileDrive($path)
    {
        Storage::cloud()->delete($path);
        return true;
    }
}

if (!function_exists('parserImgPdf')) {
    function parserImgPdf($img)
    {
        $path = base_path('storage/app/public/' . $img);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $image = 'data:image' . $type . ';base64,' . base64_encode($data);
        return $image;
    }
}
