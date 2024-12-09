import BreadCrumb from '@/shared/BreadCrumb';

export default function Show() {
  return (
    <div className="space-y container">
      <BreadCrumb
        links={[
          { title: 'خدمات', href: route('reward-programs.index') },
          { title: 'خدمت', href: '#' },
        ]}
      />
    </div>
  );
}
