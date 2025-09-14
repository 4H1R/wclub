import config from '@/fixtures/config';
import { HiBars3BottomLeft } from 'react-icons/hi2';

export default function MobileDrawerToggle() {
  return (
    <div className="xl:hidden">
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
