import Button from '@/shared/forms/Button';
import { cn } from '@/utils';
import { HiLink } from 'react-icons/hi2';
import { toast } from 'react-toastify';

type ShareButtonProps = {
  className?: string;
  predefinedStyleFor?: 'mobile' | 'desktop';
};

export default function ShareButton({ className, predefinedStyleFor }: ShareButtonProps) {
  const handleShare = () => {
    navigator.clipboard.writeText(route(route().current() as string, route().params));
    toast.success('لینک اشتراک گذاری با موفقیت برای شما کپی شد.');
  };

  return (
    <Button
      onClick={handleShare}
      aria-label="اشتراک گذاری لینک"
      className={cn(
        'btn btn-ghost',
        { 'btn-circle hidden md:flex': predefinedStyleFor === 'desktop' },
        className,
      )}
    >
      <HiLink className="size-6" />
    </Button>
  );
}
