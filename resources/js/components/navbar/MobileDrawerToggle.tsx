import config from '@/fixtures/config';
import { cn } from '@/utils';
import { usePage } from '@inertiajs/react';
import { HiBars3BottomLeft } from 'react-icons/hi2';

export default function MobileDrawerToggle() {
  const { auth } = usePage().props;

  return (
    <div className={cn('xl:hidden', { 'w-min sm:w-1/2': !auth.user })}>
      <label
        htmlFor={config.mobileDrawerId}
        aria-label="بازکردن منو بغل"
        className="btn btn-square btn-ghost"
      >
        <HiBars3BottomLeft className="size-6" />
      </label>
    </div>
  );
}
