<?php

namespace Database\Factories;

use App\Models\Folder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $folder = Folder::pluck('id')->toArray();
        $currency = ['AZN', 'USD'];
        $contract_type = ['Partnyorluq', 'Xidmət', 'Alqı-satqı'];
        $shopping = ['Biz alırıq', 'Biz satırıq'];
        $document_type = ['Müqavilə', 'Müqaviləyə Əlavə', 'Protokol', 'Təhvil-təslim aktı'];
        return [
            'number' => rand(15, 100),
            'document_type' => $data['document_type'],
            'date' => $data['date'],
            'folder_id' => $folderId,
            'currency' => $data['currency'],
            'price' => $data['price'],
            'file' => $data['file'],
            'document_id' => $document->id,
            'contract_id' => $data['contract_id'] ?? null,
            'addition_id' => $data['addition_id'] ?? null,
            'contract_type' => $data['contract_type'] ?? null,
            'shopping' => $data['shopping'] ?? null,
            'other_side_type' => $data['other_side_type'] ?? null,
            'other_side_name' => $data['other_side_name'] ?? null,
            'product_service_name' => $data['product_service_name'] ?? null,
            'product_service_number_integer' => $data['product_service_number_integer'] ?? null,
            'product_service_number_string' => $data['product_service_number_string'] ?? null,
        ];
    }
}
