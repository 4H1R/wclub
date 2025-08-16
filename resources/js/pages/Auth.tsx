import config from '@/fixtures/config';
import Button from '@/shared/forms/Button';
import Head from '@/shared/Head';
import { router } from '@inertiajs/react';
import { useEffect } from 'react';
import { toast } from 'react-toastify';

export default function Auth() {
  useEffect(() => {
    if (route().params['error']) {
      toast.error('درخواست اصفهان من شما با خطا مواجه شد. لطفا دوباره سعی کنید.');
    }
  }, []);

  const handleRedirect = () => {
    router.get(route('auth.my-isfahan'));
  };

  return (
    <div className="container relative mt-10 flex flex-1 flex-col items-center justify-center">
      <Head
        canonicalUrl={route('auth')}
        title="حساب کاربری"
        description={`ورود یا ایجاد حساب کاربری خود در ${config.websiteTitle}`}
      />
      <div className="w-full space-y-4 rounded-box bg-base-200 p-6 md:max-w-xl">
        <h1 className="text-center text-3xl font-black">حساب کاربری {config.websiteTitle}</h1>
        <p className="text-center text-base-content/80">
          شما میتوانید از طریق گزینه های زیر به حساب کاربری خود وارد شوید یا حساب کاربری جدیدی ایجاد
          کنید.
        </p>
        <div className="divider" />
        <Button onClick={handleRedirect} className="btn btn-primary btn-block mt-4">
          ورود با اصفهان من
        </Button>
      </div>
    </div>
  );
}
