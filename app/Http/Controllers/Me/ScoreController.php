<?php

namespace App\Http\Controllers\Me;

use App\Enums\Coupon\CouponTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\User;
use App\Settings\ScoreSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Vinkla\Hashids\Facades\Hashids;

class ScoreController extends Controller
{
    public function convertToCoupon(Request $request, ScoreSettings $scoreSettings): RedirectResponse
    {
        $request->validate([
            'index' => ['required', 'integer', 'min:0', 'max:'.count($scoreSettings->score_to_coupon_logic)],
        ]);

        $value = $scoreSettings->score_to_coupon_logic[$request->input('index')];
        abort_if($value['score_amount'] > Auth::user()->score, 403);
        $coupon = null;

        DB::transaction(function () use ($value, &$coupon) {
            User::query()
                ->where('id', Auth::id())
                ->decrement('score', $value['score_amount']);

            Auth::user()->scoreLogs()->create([
                'score' => $value['score_amount'] * -1,
                'text' => sprintf('تبدیل %s امتیاز به کد تخفیف %s تومانی', $value['score_amount'], $value['coupon_amount']),
            ]);

            $code = Hashids::connection('users')->encode(Auth::id()).Hashids::connection('coupons')->encode(strtotime(now()->toDateTimeString()));

            $coupon = Coupon::create([
                'user_id' => Auth::id(),
                'type' => CouponTypeEnum::Amount,
                'title' => sprintf('کد تخفیف %s تومان', $value['coupon_amount']),
                'code' => $code,
                'amount' => $value['coupon_amount'],
                'expired_at' => now()->addMonth(),
            ]);
        }, 3);

        if (! $coupon) {
            throw ValidationException::withMessages(['message' => 'مشکلی پیش آمده لطفا بعدا تلاش کنید']);
        }

        return back();
    }

    public function transferToMyIsfahan(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'amount' => ['required', 'integer', 'min:1', 'max:'.Auth::user()->score],
        ]);

        DB::transaction(function () use ($validated) {
            User::query()
                ->where('id', Auth::id())
                ->decrement('score', $validated['amount']);

            Auth::user()->scoreLogs()->create([
                'score' => $validated['amount'] * -1,
                'text' => sprintf('انتقال %s امتیاز به اصفهان من', $validated['amount']),
            ]);

            // handle transfer
        }, 3);

        return back();
    }
}
