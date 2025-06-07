import { cn } from '@/utils';
import { FaExclamation } from 'react-icons/fa6';

type NoRecordsProps = {
  className?: string;
  text?: string;
};

export default function NoRecords({ className, text = 'هیچ نتیجه‌ای یافت نشد.' }: NoRecordsProps) {
  return (
    <div
      className={cn(
        'card-bordered col-span-full flex h-44 flex-col items-center justify-center gap-4 rounded-box bg-base-100 shadow-sm',
        className,
      )}
    >
      <div className="rounded-full bg-base-200 p-4">
        <FaExclamation className="size-6" />
      </div>
      <h3 className="text-xl font-bold">{text}</h3>
    </div>
  );
}
