import { PageProps } from '@/@types';
import Button from '@/shared/forms/Button';
import { Link, router, usePage } from '@inertiajs/react';
import compact from 'lodash/compact';
import { useMemo } from 'react';
import Avatar from './Avatar';

type TLink = {
  title: string;
  href: string;
  openOnNewTab?: boolean;
};

export default function Profile() {
  const { auth } = usePage<PageProps>().props;
  const fullName = useMemo(() => {
    if (!auth.user) return '';
    if (auth.user.first_name.startsWith('ک') && auth.user.last_name.startsWith('س')) {
      return auth.user.first_name;
    }
    return `${auth.user.first_name} ${auth.user.last_name}`;
  }, [auth]);

  const authLinks: TLink[] = compact([
    { title: 'داشبورد', href: route('dashboard') },
    auth.user?.can_access_admin_panel && {
      title: 'پنل کاربران بالا رده',
      href: `/admin`,
      openOnNewTab: true,
    },
  ]);

  return (
    <div className="dropdown dropdown-end">
      <label tabIndex={0} className="avatar btn btn-circle btn-ghost">
        <Avatar title={auth.user ? fullName : '?'} />
      </label>
      <ul
        tabIndex={0}
        className="menu dropdown-content menu-sm z-[1] mt-3 w-36 gap-2 rounded-box bg-base-100 p-2 shadow"
      >
        {authLinks.map((link) => (
          <li key={link.title}>
            {link.openOnNewTab ? (
              <a target="_blank" href={link.href} rel="noreferrer">
                {link.title}
              </a>
            ) : (
              <Link href={link.href}>{link.title}</Link>
            )}
          </li>
        ))}
        {auth.user && (
          <li>
            <Button onClick={() => router.post(route('logout'))}>خروج</Button>
          </li>
        )}
      </ul>
    </div>
  );
}
