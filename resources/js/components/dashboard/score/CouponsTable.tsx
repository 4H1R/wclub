import { formatDatetime } from '@/utils';
import { digitsEnToFa } from '@persian-tools/persian-tools';
import React from 'react';
import { HiOutlineClipboard } from 'react-icons/hi2';
import { toast } from 'react-toastify';

type CouponsTableProps = {
  coupons: App.Data.Coupon.CouponData[];
};

const headers = ['#', 'نام', 'کد', 'تاریخ انقضا'];

export default function CouponsTable({ coupons }: CouponsTableProps) {
  const handleCopy = (text: string) => {
    navigator.clipboard.writeText(text);
    toast.success('کد تخفیف با موفقیت کپی شد');
  };

  return (
    <div className="collapse collapse-arrow col-span-full border border-base-200 bg-base-100">
      <input defaultChecked type="checkbox" />
      <div className="collapse-title text-xl font-medium">کد های تخفیف</div>
      <div className="collapse-content overflow-x-auto">
        <p className="text-sm text-base-content/80">
          کد های تخفیف فعال و منقضی شده ساخته شده خود را میتوانید در این قسمت ببنیید
        </p>
        <table className="table table-zebra table-pin-rows">
          <thead>
            <tr>
              {headers.map((header) => (
                <th key={header}>{header}</th>
              ))}
            </tr>
          </thead>
          <tbody>
            {coupons.map((coupon, i) => (
              <tr key={coupon.id}>
                <th>{digitsEnToFa(i + 1)}</th>
                <td>{digitsEnToFa(coupon.title)}</td>
                <td>{coupon.code}</td>
                <td>{formatDatetime(coupon.expired_at)}</td>
                <th>
                  <button
                    onClick={() => handleCopy(coupon.code)}
                    className="btn btn-circle btn-ghost btn-sm"
                  >
                    <HiOutlineClipboard className="size-5" />
                  </button>
                </th>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
}
