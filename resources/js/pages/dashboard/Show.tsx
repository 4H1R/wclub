import Head from '@/shared/Head';
import { usePage } from '@inertiajs/react';
import { useEffect } from 'react';
import { toast } from 'react-toastify';

export default function Show() {
  const { auth } = usePage().props;

  useEffect(() => {
    if (route().params['auth_was_successful']) {
      toast.success('شما با موفقیت وارد حساب کاربری خود شدید.');
    }
  }, []);

  return (
    <div className="space-y mt-page container">
      <Head title="داشبورد" description="داشبورد" titleSuffix={null} />
      <h1 className="h1 text-base-content">
        <span className="text-primary-solo">
          {auth.user?.first_name} {auth.user?.last_name}
        </span>{' '}
        خوش آمدید.
      </h1>
    </div>
  );
}
