<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function scopeNumber($query, $number)
    {
        if (!is_null($number))
            return $query->where('number', 'LIKE', '%' . $number . '%');
    }

    public function scopeDate($query, $start, $end)
    {
        if (!is_null($start) && !is_null($end))
            return $query->whereBetween('date', [$start, $end]);
        elseif (!is_null($start) && is_null($end))
            return $query->whereDate('date', '>=', $start);
        elseif (is_null($start) && !is_null($end))
            return $query->whereDate('date', '<=', $end);
    }

    public function scopeCurrency($query, $currency)
    {
        if (!is_null($currency))
            return $query->where('currency', $currency);

    }

    public function scopeDocumentType($query, $document_type)
    {
        if (!is_null($document_type))
            return $query->whereHas('documentDetail', function ($query) use ($document_type) {
                $query->where('document_type', $document_type);
            });
    }

    public function scopePrice($query, $price)
    {
        if (!is_null($price))
            return $query->where('price', $price);
    }

    public function scopeContract($query, $contract_id)
    {
        if (!is_null($contract_id))
            return $query->whereHas('documentDetail', function ($query) use ($contract_id) {
                $query->where('contract_id', $contract_id);
            });

    }

    public function scopeAddition($query, $addition_id)
    {
        if (!is_null($addition_id))
            return $query->whereHas('documentDetail', function ($query) use ($addition_id) {
                $query->where('addition_id', $addition_id);
            });
    }

    public function scopeContractType($query, $contract_type)
    {
        if (!is_null($contract_type))
            return $query->whereHas('documentDetail', function ($query) use ($contract_type) {
                $query->where('contract_type', $contract_type);
            });
    }

    public function scopeShopping($query, $shopping)
    {
        if (!is_null($shopping))
            return $query->whereHas('documentDetail', function ($query) use ($shopping) {
                $query->where('shopping', $shopping);
            });
    }

    public function scopeOtherSideType($query, $other_side_type)
    {
        if (!is_null($other_side_type))
            return $query->whereHas('documentDetail', function ($query) use ($other_side_type) {
                $query->where('other_side_type', $other_side_type);
            });
    }

    public function scopeOtherSideName($query, $other_side_name)
    {
        if (!is_null($other_side_name))
            return $query->whereHas('documentDetail', function ($query) use ($other_side_name) {
                $query->where('other_side_name', $other_side_name);
            });
    }

    public function scopeProductServiceName($query, $product_service_name)
    {
        if (!is_null($product_service_name))
            return $query->whereHas('documentDetail', function ($query) use ($product_service_name) {
                $query->where('product_service_name', 'LIKE', '%' . $product_service_name . '%');
            });
    }

    public function scopeProductServiceNumberInteger($query, $product_service_number_integer)
    {
        if (!is_null($product_service_number_integer))
            return $query->whereHas('documentDetail', function ($query) use ($product_service_number_integer) {
                $query->where('product_service_number_integer', $product_service_number_integer);
            });
    }

    public function scopeProductServiceNumberString($query, $product_service_number_string)
    {
        if (!is_null($product_service_number_string))
            return $query->whereHas('documentDetail', function ($query) use ($product_service_number_string) {
                $query->where('product_service_number_string', 'LIKE', '%' . $product_service_number_string . '%');
            });
    }

    public function upload(): HasOne
    {
        return $this->hasOne(Upload::class);
    }

    public function documentDetail(): HasOne
    {
        return $this->hasOne(DocumentDetail::class);
    }

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'document_tag');
    }
}
