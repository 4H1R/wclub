import Button from '@/shared/forms/Button';
import { usePage } from '@inertiajs/react';
import { addCommas, digitsEnToFa } from '@persian-tools/persian-tools';
import React from 'react';

export default function TransferScoreCard() {
  const { auth } = usePage().props;

  return (
    <div className="card card-bordered card-compact bg-base-100">
      <div className="card-body">
        <h2 className="card-title">انتقال امتیازات به اصفهان من</h2>
        <p className="text-base-content/80">
          شما میتوانید{' '}
          <span className="font-bold underline">{digitsEnToFa(addCommas(auth.user!.score))}</span>{' '}
          امتیاز خود را به حساب کاربری اصفهان من انتقال دهید و امتیازات خود را در آنجا استفاده کنید!
        </p>
        <div className="card-actions justify-end">
          <Button disabled={!auth.user?.score} className="btn btn-sm">
            انتقال امتیازات
          </Button>
        </div>
      </div>
    </div>
  );
}
