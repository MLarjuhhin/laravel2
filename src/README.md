dd(collect($item)->pluck($id));

<hr>

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategoty extends Model
{
use HasFactory;
use SoftDeletes;


$fillable это какие поля можно изменять
    protected $fillable=[
        'title',
        'slug',
        'parent_id',
        'description'
    ];
}

<hr>