import { PageProps } from '@/@types';
import Button from '@/shared/forms/Button';
import { router, usePage } from '@inertiajs/react';
import React, { useState } from 'react';

export default function Account() {
  const [isLoggingOut, setIsLoggingOut] = useState(false);
  const { auth } = usePage<PageProps>().props;

  const handleLogout = () => {
    setIsLoggingOut(true);
    router.post(route('logout'), undefined, {});
  };

  return (
    <>
      {auth.user?.can_access_admin_panel && (
        <div className="card card-bordered card-compact bg-base-100">
          <div className="card-body">
            <h2 className="card-title">پنل کاربران بالا رده</h2>
            <p className="text-base-content/80">
              شما دسترسی به پنل کاربران بالا رده دارید درصورت نیاز به مدیریت میتوانید به آن پنل
              بروید.
            </p>
            <div className="card-actions justify-end">
              <a href="/admin" target="_blank" className="btn btn-sm">
                ورود به پنل
              </a>
            </div>
          </div>
        </div>
      )}
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
