import Button from '@/shared/forms/Button';
import { handleServerMessage } from '@/utils';
import { router, usePage } from '@inertiajs/react';
import { addCommas, digitsEnToFa } from '@persian-tools/persian-tools';
import React, { useState } from 'react';
import { toast } from 'react-toastify';

type ConvertToCouponCardProps = {
  logic: { score_amount: number; coupon_amount: number }[];
};

export default function ConvertToCouponCard({ logic }: ConvertToCouponCardProps) {
  const { auth } = usePage().props;
  const [showList, setShowList] = useState(false);
  const [selectedIndex, setSelectedIndex] = useState<number | null>(null);
  const [isLoading, setIsLoading] = useState(false);

  const handleConvert = () => {
    if (selectedIndex === null) return;
    const { score_amount } = logic[selectedIndex];

    if (score_amount > auth.user!.score) {
      toast.error(
        `شما ${score_amount - auth.user!.score} امتیاز بیشتری برای استفاده این گزینه نیاز دارید`,
      );
      return;
    }

    setIsLoading(true);
    router.post(
      route('me.score.convert-to-coupon'),
      { index: selectedIndex },
      {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
          toast.success(
            'کد تخفیف با موفقیت ساخته شد. میتوانید کد تخفیف خود را در پایین صفحه ببینید',
          );
        },
        onError: handleServerMessage,
        onFinish: () => setIsLoading(false),
      },
    );
  };

  return (
    <div className="card card-bordered card-compact bg-base-100">
      <div className="card-body">
        <h2 className="card-title">خرید کد تخفیف</h2>
        <p className="text-base-content/80">
          شما میتوانید با{' '}
          <span className="font-bold underline">{digitsEnToFa(addCommas(auth.user!.score))}</span>{' '}
          امتیاز کد تخفیف بخرید و در بانوان اصفهان آن را استفاده کنید!
        </p>
        <p className="text-base-content/80">
          کد های تخفیف فقط یک <span className="underline">بار مصرف</span> و تا{' '}
          <span className="underline">یک ماه</span> قابل استفاده میباشند.
        </p>
        {showList && (
          <div className="mt-2 space-y-2">
            {logic.map((value, i) => (
              <label
                key={`${value.score_amount}_${value.coupon_amount}`}
                className={'form-control flex-row gap-4 text-sm'}
              >
                <input
                  onChange={() => setSelectedIndex(i)}
                  name="convert_to_coupon_value"
                  type="radio"
                  className="radio radio-sm"
                />
                <span>
                  {digitsEnToFa(addCommas(value.score_amount))} امتیاز به{' '}
                  {digitsEnToFa(addCommas(value.coupon_amount))} تومان کد تخفیف
                </span>
              </label>
            ))}
          </div>
        )}
        <div className="card-actions justify-end">
          {showList ? (
            <Button
              onClick={handleConvert}
              disabled={selectedIndex === null || isLoading}
              isLoading={isLoading}
              className="btn btn-primary btn-sm"
            >
              ساخت کد تخفیف
            </Button>
          ) : (
            <Button onClick={() => setShowList(true)} className="btn btn-sm">
              نمایش لیست تبدیل
            </Button>
          )}
        </div>
      </div>
    </div>
  );
}
