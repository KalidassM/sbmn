<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model; use Illuminate\Support\Facades\Storage;
class CommitteeMember extends Model { protected $fillable=['name','role','mobile','photo']; protected $appends=['photo_url']; public function getPhotoUrlAttribute(){ return $this->photo ? Storage::disk(config('filesystems.uploads_disk'))->url($this->photo) : null; } }
