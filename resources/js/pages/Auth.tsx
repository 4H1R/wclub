import config from '@/fixtures/config';
import Head from '@/shared/Head';
import { Link } from '@inertiajs/react';

export default function Auth() {
  return (
    <div className="container relative mt-10 flex flex-1 items-center justify-center">
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
        <Link disabled href={route('auth.my-isfahan')} className="btn btn-primary btn-block mt-4">
          <span>ورود با اصفهان من</span>
        </Link>
      </div>
    </div>
  );
}
