import { navbarLinks } from '@/fixtures/links';
import { cn } from '@/utils';
import { Link, usePage } from '@inertiajs/react';

export default function DesktopLinks() {
  const url = usePage().url;

  return (
    <nav className="navbar-center hidden lg:flex">
      <ul className="menu menu-horizontal px-1 lg:gap-4">
        {navbarLinks
          .filter((link) => link.showOn !== 'mobile')
          .map((link) => (
            <li
              className={cn({
                'border-b border-primary text-primary hover:border-none': url === link.href,
              })}
              key={link.title}
            >
              <Link href={link.href}>{link.title}</Link>
            </li>
          ))}
      </ul>
    </nav>
  );
}
