import { TNavbarLink } from '@/fixtures/links';
import { cn, isUrlActive } from '@/utils';
import { Link, usePage } from '@inertiajs/react';
import { useId } from 'react';

type DesktopSubLinkProps = {
  link: TNavbarLink;
};

export default function DesktopSubLink({ link }: DesktopSubLinkProps) {
  const url = usePage().url;
  const id = useId();

  const handleClose = () => {
    document.getElementById(id)?.removeAttribute('open');
  };

  if (!link.desktopSubLinks) return null;

  return (
    <details id={id}>
      <summary>{link.title}</summary>
      <ul className="rounded-t-none bg-base-100">
        {link.desktopSubLinks.map((subLink) => (
          <li key={subLink.href}>
            <Link
              onClick={handleClose}
              className={cn({ 'text-primary': isUrlActive(url, subLink.href) })}
              href={subLink.href}
            >
              {subLink.title}
            </Link>
          </li>
        ))}
      </ul>
    </details>
  );
}
