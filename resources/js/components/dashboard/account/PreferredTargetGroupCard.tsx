import { PageProps } from '@/@types';
import { calculateAge } from '@/utils';
import { router, usePage } from '@inertiajs/react';

export default function PreferredTargetGroupCard() {
  const { target_groups, active_target_group_id, auth } = usePage<PageProps>().props;
  const age = calculateAge(auth.user!.birth_date);

  const preferredTargetGroup = target_groups.find(
    (targetGroup) => targetGroup.min_age <= age && targetGroup.max_age >= age,
  );

  if (!preferredTargetGroup) return null;

  const handleChangeTargetGroup = (checked: boolean) => {
    if (!checked) {
      return router.delete(route('target-groups.active'));
    }

    router.post(route('target-groups.active'), {
      target_group_id: preferredTargetGroup.id,
    });
  };

  return (
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
  );
}
