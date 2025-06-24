import Head from '@/shared/Head';
import React from 'react';
import { FaExclamation } from 'react-icons/fa6';

export default function CleanLife() {
  return (
    <div className="space-y mt-page container">
      <Head
        canonicalUrl={route('clean-life')}
        title="زن والگوی سوم و زیست عفیفانه"
        description="زن والگوی سوم و زیست عفیفانه"
      />
      <h1 className="h1">زن والگوی سوم و زیست عفیفانه</h1>
      <div className="card-bordered col-span-full flex h-44 flex-col items-center justify-center gap-4 rounded-box bg-base-200 shadow-sm">
        <div className="rounded-full bg-base-300 p-4">
          <FaExclamation className="size-6" />
        </div>
        <h3 className="text-xl font-bold">
          ما در حال تکمیل بخش زن والگوی سوم و زیست عفیفانه هستیم لطفا چند روز دیگر چک کنید
        </h3>
      </div>
    </div>
  );
}
