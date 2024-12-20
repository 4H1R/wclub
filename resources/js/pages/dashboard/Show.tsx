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

  const scores = [
    `${digitsEnToFa(20)} امتیاز بابت خواندن همه رویداد ها`,
    `${digitsEnToFa(20)} امتیاز بابت برنده شدن تاس سی`,
    `${digitsEnToFa(20)} امتیاز بابت چرخوندن گردونه`,
    `${digitsEnToFa(20)} امتیاز بابت شرکت در رویداد`,
    `${digitsEnToFa(40)} امتیاز بابت ورود به باشگاه بانوان به مدت ${digitsEnToFa(30)} روز`,
    `${digitsEnToFa(30)} امتیاز بابت دیدن دوره`,
    `مجموع ${digitsEnToFa(155)} امتیاز`,
  ];

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
            <span className="font-fa-display">{digitsEnToFa(addCommas(150))}</span>
          </div>
        </div>
      </div>
      <div className="divider" />
      <div className="card card-bordered bg-base-200 md:max-w-[50%]">
        <div className="card-body">
          <h3 className="card-title">لیست امتیاز ها</h3>
          <ul className="mt-4 list-inside list-disc">
            {scores.map((text, i) => (
              <li key={i}>{text}</li>
            ))}
          </ul>
        </div>
      </div>
    </div>
  );
}
