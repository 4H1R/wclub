import Button from '@/shared/forms/Button';
import { slugifyId } from '@/utils';
import { router, useForm, usePage } from '@inertiajs/react';
import { HiCheckBadge } from 'react-icons/hi2';
import { toast } from 'react-toastify';
import UploadImage from './UploadImage';

type RegisterContestProps = {
  contest: App.Data.Contest.ContestFullData;
};

export default function RegisterContest({ contest }: RegisterContestProps) {
  const { auth } = usePage().props;
  const hasPassedRegistration = new Date(contest.finished_at).getTime() < new Date().getTime();
  const canInteract = contest.has_registered && !hasPassedRegistration;
  const registerForm = useForm();

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
    registerForm.post(
      route('contests.registrations.store', [slugifyId(contest.id, contest.title)]),
      {
        onSuccess: () => {
          toast.success(`شما با موفقیت در چالش و مسابقه ${contest.title} ثبت نام کردید`);
        },
      },
    );
  };

  return (
    <div className="flex w-full flex-col gap-2">
      {contest.question_form_answered && (
        <div className="flex items-center gap-2">
          <HiCheckBadge className="size-6 text-primary" />
          <p className="text-base-content/80">شما پاسخ به سوالات را ثبت کرده اید.</p>
        </div>
      )}
      <UploadImage contest={contest} canInteract={canInteract} />
      {canInteract && contest.question_form_id && !contest.question_form_answered && (
        <a
          target="_blank"
          className="btn btn-neutral btn-block"
          href={route('question-forms.show', [contest.question_form_id])}
          rel="noreferrer"
        >
          پاسخ به سوالات
        </a>
      )}
      {!contest.has_registered && (
        <Button
          onClick={handleRegister}
          disabled={hasPassedRegistration || registerForm.processing}
          className="btn btn-neutral btn-block"
        >
          {getText()}
        </Button>
      )}
    </div>
  );
}
