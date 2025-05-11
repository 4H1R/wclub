import { cn } from '@/utils';
import React from 'react';
import { GoDotFill } from 'react-icons/go';
import { HiChatBubbleBottomCenter } from 'react-icons/hi2';
import FaqCard from './FaqCard';

type FaqsProps = {
  className?: string;
  faqs: App.Data.Faq.FaqData[];
};

export default function Faqs({ className, faqs }: FaqsProps) {
  return (
    <div
      className={cn(
        'card card-compact col-span-full mt-4 bg-base-200 md:card-normal lg:col-span-7',
        className,
      )}
    >
      <div className="card-body md:gap-6">
        <div className="flex items-center justify-between gap-2">
          <div className="flex items-center justify-center gap-2 md:justify-start">
            <GoDotFill className="hidden size-4 md:block" />
            <h2 className="h3 text-base-content md:text-start">پرسش و پاسخ ها</h2>
          </div>
          <div className="flex items-start gap-2">
            <button className="btn btn-primary btn-sm">
              <span>ایجاد پرسش</span>
              <HiChatBubbleBottomCenter className="size-5" />
            </button>
          </div>
        </div>
        <div className="space-y-2">
          {faqs.map((faq) => (
            <FaqCard key={faq.id} faq={faq} />
          ))}
        </div>
      </div>
    </div>
  );
}
