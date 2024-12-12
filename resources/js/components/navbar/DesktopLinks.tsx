import { navbarLinks } from '@/fixtures/links';
import { cn, isUrlActive } from '@/utils';
import { Link, usePage } from '@inertiajs/react';
import DesktopSubLink from './DesktopSubLink';

export default function DesktopLinks() {
  const url = usePage().url;

  return (
    <nav className="navbar-center mr-auto hidden lg:flex">
      <ul className="menu menu-horizontal px-1 lg:gap-4">
        {navbarLinks
          .filter((link) => link.showOn !== 'mobile')
          .map((link) => (
            <li
              className={cn({
                'border-b border-primary-solo font-medium text-primary-solo hover:border-none':
                  isUrlActive(url, link.href),
              })}
              key={link.title}
            >
              {link.desktopSubLinks ? (
                <DesktopSubLink link={link} />
              ) : (
                <Link href={link.href}>{link.title}</Link>
              )}
            </li>
          ))}
      </ul>
    </nav>
  );
}
