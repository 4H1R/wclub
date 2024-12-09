import { Link } from '@inertiajs/react';

export type TBreadcrumb = {
  title: string;
  href: string;
};

type BreadCrumbProps = {
  links: TBreadcrumb[];
};

export default function BreadCrumb({ links }: BreadCrumbProps) {
  return (
    <div className="breadcrumbs text-base">
      <ul>
        {links.map((link) => (
          <li className="last:text-base-content/80" key={link.title}>
            <Link href={link.href}>{link.title}</Link>
          </li>
        ))}
      </ul>
    </div>
  );
}
