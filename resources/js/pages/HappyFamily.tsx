import Head from '@/shared/Head';
import React from 'react';
import { FaExclamation } from 'react-icons/fa6';

export default function HappyFamily() {
  return (
    <div className="space-y mt-page container">
      <Head canonicalUrl={route('happy-family')} title="خانواده شاد" description="خانواده شاد" />
      <h1 className="h1">خانواده شاد</h1>
      <div className="card-bordered col-span-full flex h-44 flex-col items-center justify-center gap-4 rounded-box bg-base-200 shadow-sm">
        <div className="rounded-full bg-base-300 p-4">
          <FaExclamation className="size-6" />
        </div>
        <h3 className="text-xl font-bold">
          ما در حال تکمیل بخش خانواده شاد هستیم لطفا چند روز دیگر چک کنید
        </h3>
      </div>
    </div>
  );
}
