<?php

namespace App\Utility;

class ActivityGenerator
{
     const UserNamePlaceHolder = "[-user_name-]";
    /**
     * Content generates for file upload
     *
     * @param array $fileInfo file related information
     *
     * @param string $type which type of file upload
     * Ex. file, attachment, document etc
     *
     * @return string generated content
     * You uploaded a $type
     * keyword.xlsx | Size | Download
     */
    public static function uploadFile(array $fileInfo, string $type = 'file'): string
    {
        $file_content = implode(' | ', ActivityGenerator::generateFileContent($fileInfo));
        return "<div><p>[-user_name-] uploaded a $type</p><span> $file_content </span></div>";
    }

    /**
     * Generate Activity content for the update action
     *
     * @param string $title
     * @param array $infos
     * @return string content as string
     */
    public static function getContent(string $title, array $infos = []): string
    {
        $content = "<div><p>$title</p>";

        foreach ($infos as $heading => $info){
            if(count($info) > 0){
                $oldContent = implode(' | ', $info);
                if(is_numeric($heading))
                    $heading = '';
                else
                    $heading .= ':';
                $content .= "<br><span>$heading $oldContent</span>";
            }

        }
        $content .= "</div>";
        return $content;

    }

    /**
     * Content generates for file delete
     *
     * @param string $fileName file name with extensions
     *
     * @param string $type which type of file upload
     *  Ex. file, attachment, document etc
     *
     * @return string generated content
     * You deleted a file
     * filename.ext
     */
    public static function deleteFile(string $fileName, string $type = 'file'): string
    {
       return "<div><p>[-user_name-] deleted a $type</p><span>$fileName</span></div>";
    }

    public static function generateFileContent(array $fileInfo): array
    {
        if(count($fileInfo) == 0)
            return [];
        $urlLink = asset($fileInfo['path']);
        $size = round($fileInfo['size'] / 1024, 2);
        return [
            "<button type='button' class='btn btn-link' onclick='common.openFileViewModel(\"$urlLink\", \"{$fileInfo['original_name']}\")'>{$fileInfo['original_name']}</button>",
            " $size MB",
            "<a class='btn btn-link' href='$urlLink' download='{$fileInfo['original_name']}'>Download</a>"
        ];
    }
}
