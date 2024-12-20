import { useShowTooltip } from '@/hooks';
import Head from '@/shared/Head';
import { cn } from '@/utils';
import { usePage } from '@inertiajs/react';
import { addCommas, digitsEnToFa } from '@persian-tools/persian-tools';
import { useEffect } from 'react';
import { HiStar } from 'react-icons/hi2';
import { toast } from 'react-toastify';

export default function Show() {
  const { auth } = usePage().props;
  const showTooltip = useShowTooltip();

  useEffect(() => {
    if (route().params['auth_was_successful']) {
      toast.success('شما با موفقیت وارد حساب کاربری خود شدید.');
    }
  }, []);

  return (
    <div className="space-y mt-page container">
      <Head title="داشبورد" description="داشبورد" titleSuffix={null} />
      <div className="flex flex-wrap items-center justify-between gap-4">
        <h1 className="h2 text-base-content">
          <span className="text-primary-solo">
            {auth.user?.first_name} {auth.user?.last_name}
          </span>{' '}
          خوش آمدید.
        </h1>
        <div
          className={cn('tooltip tooltip-bottom', {
            'tooltip-open animate-bounce': showTooltip,
          })}
          data-tip="امتیاز شما"
        >
          <div className="badge badge-lg flex items-center justify-center gap-2 bg-yellow-600 text-white">
            <HiStar className="size-4" />
            <span className="font-fa-display">
              {digitsEnToFa(addCommas(auth.user?.score ?? 0))}
            </span>
          </div>
        </div>
      </div>
    </div>
  );
}
