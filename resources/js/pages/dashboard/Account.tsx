import Button from '@/shared/forms/Button';
import Head from '@/shared/Head';
import { router } from '@inertiajs/react';
import React, { useState } from 'react';

export default function Account() {
  const [isLoggingOut, setIsLoggingOut] = useState(false);

  const handleLogout = () => {
    setIsLoggingOut(true);
    router.post(route('logout'), undefined, {});
  };

  return (
    <>
      <Head title="حساب من" description="حساب من" />
      <div className="card card-bordered card-compact bg-base-100">
        <div className="card-body">
          <h2 className="card-title">خروج از حساب کاربری خود</h2>
          <p className="text-base-content/80">
            شما میتوانید از حساب کاربری خود خارج شوید اگر میخواهید با حساب کاربری دیگری وارد شوید!
          </p>
          <div className="card-actions justify-end">
            <Button
              disabled={isLoggingOut}
              isLoading={isLoggingOut}
              onClick={handleLogout}
              className="btn btn-sm"
            >
              خروج
            </Button>
          </div>
        </div>
      </div>
    </>
  );
}
