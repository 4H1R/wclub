import { PageProps } from '@/@types';
import Button from '@/shared/forms/Button';
import Head from '@/shared/Head';
import { calculateAge } from '@/utils';
import { router, usePage } from '@inertiajs/react';
import React, { useState } from 'react';

export default function Account() {
  const [isLoggingOut, setIsLoggingOut] = useState(false);
  const { target_groups, active_target_group_id, auth } = usePage<PageProps>().props;

  const age = calculateAge(auth.user!.birth_date);

  const preferredTargetGroup = target_groups.find(
    (targetGroup) => targetGroup.min_age <= age && targetGroup.max_age >= age,
  );

  const handleChangeTargetGroup = (checked: boolean) => {
    if (!preferredTargetGroup) return;

    if (!checked) {
      return router.delete(route('target-groups.active'));
    }

    router.post(route('target-groups.active'), {
      target_group_id: preferredTargetGroup.id,
    });
  };

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
      {preferredTargetGroup && (
        <div className="card card-bordered card-compact bg-base-100">
          <div className="card-body">
            <h2 className="card-title">تنظیم صفحه اصلی بر اساس من</h2>
            <p className="text-base-content/80">
              صفحه اصلی بر اساس مطالبی که ما فکر میکنیم برای شما مفید هستند نظیم شوند.
            </p>
            <div className="card-actions justify-end">
              <input
                type="checkbox"
                className="toggle toggle-primary"
                defaultChecked={active_target_group_id === preferredTargetGroup.id}
                onChange={(e) => handleChangeTargetGroup(e.target.checked)}
              />
            </div>
          </div>
        </div>
      )}
    </>
  );
}
