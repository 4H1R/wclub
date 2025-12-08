import Button from '@/shared/forms/Button';
import { slugifyId } from '@/utils';
import { router, useForm, usePage } from '@inertiajs/react';
import { toast } from 'react-toastify';

type RegisterEventProgramProps = {
  eventProgram: App.Data.EventProgram.EventProgramFullData;
};

export default function RegisterEventProgram({ eventProgram }: RegisterEventProgramProps) {
  const { auth } = usePage().props;
  const hasPassedRegistration = new Date(eventProgram.finished_at).getTime() < new Date().getTime();
  const registerForm = useForm();

  const getText = () => {
    if (hasPassedRegistration) return 'تاریخ گذشته است';
    if (eventProgram.has_registered) return 'شما قبلا ثبت نام کرده اید.';
    return 'ثبت نام';
  };

  const handleRegister = () => {
    if (!auth.user) {
      toast.warning('برای ثبت نام لطفا وارد حساب کاربری خود شوید.');
      router.get(route('auth'));
      return;
    }
    registerForm.post(
      route('event-programs.registrations.store', [slugifyId(eventProgram.id, eventProgram.title)]),
      {
        onSuccess: () => {
          toast.success(`شما با موفقیت در رویداد ${eventProgram.title} ثبت نام کردید`);
        },
      },
    );
  };

  return (
    <Button
      onClick={handleRegister}
      disabled={hasPassedRegistration || registerForm.processing || eventProgram.has_registered}
      className="btn btn-neutral btn-block"
    >
      {getText()}
    </Button>
  );
}
