import Button from '@/shared/forms/Button';
import { slugifyId } from '@/utils';
import { router, usePage } from '@inertiajs/react';
import { HiOutlineLibrary } from 'react-icons/hi';
import { toast } from 'react-toastify';

type CartActionProps = {
  series: App.Data.Series.SeriesFullData;
};

const className = 'btn btn-primary';

export default function CartAction({ series }: CartActionProps) {
  const { auth } = usePage().props;

  const handleOwn = () => {
    if (!auth.user) {
      toast.warning(
        'برای اینکه این دوره به لیست دوره های شما اضافه بشه باید به حساب کاربری خود وارد بشید.',
      );
      router.get(route('auth'));
      return;
    }

    router.post(route('series.owns.store', [slugifyId(series.id, series.title)]), undefined, {
      onSuccess: () => {
        toast.success('این دوره به دوره های شما اضافه شد.');
      },
    });
  };

  if (series.is_owned) {
    return (
      <Button
        onClick={() => document.getElementById('chapters')?.scrollIntoView({ behavior: 'smooth' })}
        className="btn btn-neutral"
      >
        <span>سرفصل های دوره</span>
        <HiOutlineLibrary className="size-6" />
      </Button>
    );
  }

  return (
    <Button onClick={handleOwn} className={className}>
      <span>افزودن به دوره های خود</span>
      <HiOutlineLibrary className="size-6" />
    </Button>
  );
}
