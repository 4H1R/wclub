import Button from '@/shared/forms/Button';
import { slugifyId } from '@/utils';
import { router, useForm, usePage } from '@inertiajs/react';
import { toast } from 'react-toastify';

type RegisterContestProps = {
  contest: App.Data.Contest.ContestFullData;
};

export default function RegisterContest({ contest }: RegisterContestProps) {
  const { auth } = usePage().props;
  const hasPassedRegistration = new Date(contest.started_at).getTime() < new Date().getTime();
  const form = useForm();
  const getText = () => {
    if (hasPassedRegistration) return 'تاریخ گذشته است';
    if (contest.has_registered) return 'شما قبلا ثبت نام کرده اید.';
    return 'ثبت نام';
  };

  const handleRegister = () => {
    if (!auth.user) {
      toast.warning('برای ثبت نام لطفا وارد حساب کاربری خود شوید.');
      router.get(route('auth'));
      return;
    }
    form.post(route('contests.registrations.store', [slugifyId(contest.id, contest.title)]), {
      onSuccess: () => {
        toast.success(`شما با موفقیت در چالش و مسابقه ${contest.title} ثبت نام کردید`);
      },
    });
  };

  return (
    <Button
      onClick={handleRegister}
      disabled={hasPassedRegistration || contest.has_registered || form.processing}
      className="btn btn-neutral btn-block"
    >
      {getText()}
    </Button>
  );
}
