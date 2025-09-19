import { TNavbarLink } from '@/fixtures/links';
import { cn, isUrlActive } from '@/utils';
import { Link, usePage } from '@inertiajs/react';
import { useCallback, useId, useRef } from 'react';

type DesktopSubLinkProps = {
  link: TNavbarLink;
};

export default function DesktopSubLink({ link }: DesktopSubLinkProps) {
  const url = usePage().url;
  const decodedUrl = decodeURIComponent(url);
  const id = useId();
  const ref = useRef<HTMLDetailsElement>(null);

  const handleClose = useCallback(() => {
    document.getElementById(id)?.removeAttribute('open');
  }, [id]);

  if (!link.desktopSubLinks) return null;

  return (
    <details className="desktop-sub-links" ref={ref} id={id}>
      <summary>{link.title}</summary>
      <ul className={cn('w-32 min-w-fit rounded-t-none bg-base-100', link.desktopSubLinkClassName)}>
        {link.desktopSubLinks.map((subLink) => (
          <li key={subLink.href}>
            <Link
              onClick={handleClose}
              className={cn('text-base-content', {
                'text-primary-solo': isUrlActive(decodedUrl, subLink.href, true),
              })}
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
