import { useCurrentRoute, useShowTooltip } from '@/hooks';
import Button from '@/shared/forms/Button';
import Head from '@/shared/Head';
import { THasChildren } from '@/types';
import { cn } from '@/utils';
import { Link, usePage } from '@inertiajs/react';
import { addCommas, digitsEnToFa } from '@persian-tools/persian-tools';
import { useEffect, useMemo } from 'react';
import { HiStar, HiUsers } from 'react-icons/hi2';
import { toast } from 'react-toastify';
import MainLayout from './MainLayout';

type DashboardLayoutProps = THasChildren;

export default function DashboardLayout({ children }: DashboardLayoutProps) {
  const tabs = useMemo(
    () => [
      { title: 'امتیازات', href: route('dashboard.score', undefined, false) },
      { title: 'سفارشات', href: route('dashboard.orders', undefined, false) },
      { title: 'دوره ها', href: route('dashboard.series', undefined, false) },
      { title: 'حساب من', href: route('dashboard.account', undefined, false) },
    ],
    [],
  );

  const { auth } = usePage().props;
  const showTooltip = useShowTooltip();
  const currentRoute = useCurrentRoute();

  const handleCopyReferer = () => {
    window.navigator.clipboard.writeText(auth.user!.hash_id);
    toast.success('کد معرف شما با موفقیت کپی شد');
  };

  useEffect(() => {
    if (route().params['auth_was_successful']) {
      toast.success('شما با موفقیت وارد حساب کاربری خود شدید.');
    }
  }, []);

  return (
    <MainLayout>
      <div className="space-y mt-page container">
        <Head title="داشبورد" description="داشبورد" titleSuffix={null} />
        <div className="flex flex-wrap items-center justify-between gap-4">
          <h1 className="h2 text-base-content">
            <span className="text-primary-solo">
              {auth.user?.first_name} {auth.user?.last_name}
            </span>{' '}
            خوش آمدید.
          </h1>
          <div className="flex flex-wrap items-center gap-2">
            <Button
              onClick={handleCopyReferer}
              className="btn btn-xs flex items-center justify-center gap-2"
            >
              <HiUsers className="size-4" />
              <span>کپی کد معرف شما</span>
            </Button>
            <div
              className={cn('tooltip tooltip-bottom', {
                'tooltip-open animate-bounce': showTooltip,
              })}
              data-tip="امتیاز شما"
            >
              <div className="badge badge-lg flex items-center justify-center gap-2 bg-yellow-600 text-white">
                <HiStar className="size-4" />
                <span className="font-fa-display">{digitsEnToFa(addCommas(auth.user!.score))}</span>
              </div>
            </div>
          </div>
        </div>
        <div role="tablist" className="tabs tabs-bordered overflow-x-auto">
          {tabs.map((tab) => (
            <Link
              href={tab.href}
              key={tab.href}
              role="tab"
              className={cn('tab', { 'tab-active': currentRoute === tab.href })}
            >
              {tab.title}
            </Link>
          ))}
        </div>
        <div className="grid grid-cols-1 gap-4 md:grid-cols-2">{children}</div>
      </div>
    </MainLayout>
  );
}
