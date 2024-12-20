import Button from '@/shared/forms/Button';
import { cn } from '@/utils';
import { router, usePage } from '@inertiajs/react';
import { digitsEnToFa } from '@persian-tools/persian-tools';
import { motion } from 'framer-motion';
import { useState } from 'react';
import { toast } from 'react-toastify';

const countdownClassName = 'font-fa-display text-7xl';
const timeoutValue = 500;
const texts = [
  { text: digitsEnToFa(3), className: countdownClassName },
  {
    text: digitsEnToFa(2),
    className: countdownClassName,
  },
  {
    text: digitsEnToFa(1),
    className: countdownClassName,
  },
  {
    text: 'شروع',
    className: countdownClassName,
  },
  null,
];

type TText = {
  text: string;
  className: string;
};

type StarterProps = {
  onStart: () => void;
};

export default function Starter({ onStart }: StarterProps) {
  const { auth } = usePage().props;
  const [text, setText] = useState<null | TText>(null);
  const [isButtonHidden, setIsButtonHidden] = useState(false);

  const handleStart = () => {
    if (!auth.user) {
      toast.warning('برای بازی کردن و گرفتن امتیاز لطفا به حساب کاربری خود وارد شوید.');
      router.get(route('auth'));
      return;
    }
    setIsButtonHidden(true);
    let timeout = 0;

    texts.forEach((data) => {
      setTimeout(() => {
        setText(data);
      }, timeout);
      timeout += timeoutValue;
    });
    setTimeout(() => onStart(), timeout - timeoutValue);
  };

  return (
    <>
      {!isButtonHidden && (
        <Button onClick={handleStart} className="btn btn-neutral">
          شروع بازی
        </Button>
      )}
      {text && (
        <motion.span
          key={text.text}
          initial={{ opacity: 0, scale: 2 }}
          animate={{ opacity: 1, scale: 1 }}
          className={cn(text.className)}
        >
          {text.text}
        </motion.span>
      )}
    </>
  );
}
