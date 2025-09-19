import { useNavbarLinks } from '@/fixtures/links';
import { cn, isUrlActive } from '@/utils';
import { Link, usePage } from '@inertiajs/react';
import DesktopSubLink from './DesktopSubLink';

export default function DesktopLinks() {
  const url = usePage().url;
  const decodedUrl = decodeURIComponent(url);
  const navarLinks = useNavbarLinks({ showOn: 'desktop' });

  return (
    <nav className="navbar-center mr-auto hidden xl:flex">
      <ul className="menu menu-horizontal px-1 xl:gap-4">
        {navarLinks.map((link) => (
          <li
            className={cn({
              'border-b border-primary-solo font-medium text-primary-solo hover:border-none':
                isUrlActive(decodedUrl, link.href),
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
