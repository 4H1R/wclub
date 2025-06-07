import NoRecords from '@/shared/NoRecords';
import { cn, openModal } from '@/utils';
import { usePage } from '@inertiajs/react';
import React from 'react';
import { GoDotFill } from 'react-icons/go';
import { HiChatBubbleBottomCenter } from 'react-icons/hi2';
import { toast } from 'react-toastify';
import CreateModal from './CreateModal';
import FaqCard from './FaqCard';

type FaqsProps = {
  className?: string;
  faqs: App.Data.Faq.FaqData[];
  modelId: number;
};

const modalId = 'faqs-create';

export default function Faqs({ className, faqs, modelId }: FaqsProps) {
  const { auth } = usePage().props;
  const handleCreate = () => {
    if (!auth.user) {
      toast.warning('برای ایجاد پرسش باید حساب کاربری داشته باشید!');
      return;
    }
    openModal(modalId);
  };

  return (
    <div
      className={cn(
        'card card-compact col-span-full mt-4 bg-base-200 md:card-normal lg:col-span-7',
        className,
      )}
    >
      <CreateModal modalId={modalId} modelId={modelId} />
      <div className="card-body md:gap-6">
        <div className="flex items-center justify-between gap-2">
          <div className="flex items-center justify-center gap-2 md:justify-start">
            <GoDotFill className="hidden size-4 md:block" />
            <h2 className="h3 text-base-content md:text-start">پرسش و پاسخ ها</h2>
          </div>
          <div className="flex items-start gap-2">
            <button onClick={handleCreate} className="btn btn-primary btn-sm">
              <span>ایجاد پرسش</span>
              <HiChatBubbleBottomCenter className="size-5" />
            </button>
          </div>
        </div>
        <NoRecords className="border-none bg-transparent shadow-none" />
        <div className="space-y-2">
          {faqs.map((faq) => (
            <FaqCard key={faq.id} faq={faq} />
          ))}
        </div>
      </div>
    </div>
  );
}
