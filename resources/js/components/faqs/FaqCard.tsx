import { dateOptions } from '@/fixtures';
import { formatDatetime } from '@/utils';
import React from 'react';

type FaqCardProps = {
  faq: App.Data.Faq.FaqData;
};

export default function FaqCard({ faq }: FaqCardProps) {
  const fullName = 'محمد مهدی اسکایی';
  const date = formatDatetime(faq.created_at, dateOptions);

  return (
    <div className="card card-bordered bg-base-300">
      <div className="card-body">
        <div className="w-full space-y-4">
          <div className="flex items-center justify-between gap-4">
            <div className="flex items-center gap-4">
              <span className="font-medium">{fullName}</span>
            </div>
            <span className="hidden text-sm font-medium text-base-content/80 md:inline">
              {date}
            </span>
          </div>
        </div>
        <p>{faq.question}</p>
        {faq.answer && (
          <>
            <div className="divider my-1" />
            <p>
              <span className="mt-2 text-primary-solo">پاسخ : </span>
              {faq.answer}
            </p>
          </>
        )}
        <span className="text-end text-sm font-medium text-base-content/60 md:hidden">{date}</span>
      </div>
    </div>
  );
}
