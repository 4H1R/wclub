import { PageProps } from '@/@types';
import config from '@/fixtures/config';
import Button from '@/shared/forms/Button';
import Image from '@/shared/images/Image';
import { cn } from '@/utils';
import { router, usePage } from '@inertiajs/react';
import { HiOutlineChevronDown } from 'react-icons/hi2';

export default function TargetGroupSelect() {
  const { target_groups, active_target_group } = usePage<PageProps>().props;
  const targetGroups = [
    {
      id: 0,
      title: config.websiteTitle,
      image: null,
    },
    ...target_groups,
  ];

  const handleUpdateActiveTargetGroup = (targetGroupId: number) => {
    if (targetGroupId) {
      router.post(route('target-groups.active'), {
        target_group_id: targetGroupId,
      });
      return;
    }

    router.delete(route('target-groups.active'));
  };

  return (
    <div className="dropdown">
      <div tabIndex={0} role="button" className="flex items-center gap-2">
        <span className="xl:text-base xl:font-normal">
          {active_target_group?.title ?? config.websiteTitle}
        </span>
        <HiOutlineChevronDown className="size-4" />
      </div>
      <ul
        tabIndex={0}
        className="menu dropdown-content z-[1] w-52 rounded-box bg-base-100 p-2 shadow"
      >
        {targetGroups.map((targetGroup) => (
          <li key={targetGroup.id}>
            <Button
              className={cn({
                'font-medium text-primary-solo': targetGroup.id === (active_target_group?.id ?? 0),
              })}
              onClick={() => handleUpdateActiveTargetGroup(targetGroup.id)}
            >
              {targetGroup.image && (
                <Image
                  src={targetGroup.image.original_url}
                  alt={targetGroup.title}
                  className="size-4 rounded-full"
                />
              )}
              <span>{targetGroup.title}</span>
            </Button>
          </li>
        ))}
      </ul>
    </div>
  );
}
