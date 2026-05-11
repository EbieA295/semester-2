namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function toggle(Request $request, $unit_id)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())
                            ->where('unit_id', $unit_id)
                            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return back()->with('success', 'Dihapus dari wishlist.');
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'unit_id' => $unit_id
            ]);
            return back()->with('success', 'Ditambahkan ke wishlist.');
        }
    }
}
