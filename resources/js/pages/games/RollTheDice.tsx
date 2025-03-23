import { PageProps } from '@/@types';
import Starter from '@/components/games/rollTheDice/Starter';
import BreadCrumb from '@/shared/BreadCrumb';
import Head from '@/shared/Head';
import Image from '@/shared/images/Image';
import { cn } from '@/utils';
import { usePage } from '@inertiajs/react';
import { digitsEnToFa } from '@persian-tools/persian-tools';
import { motion } from 'framer-motion';
import { useEffect, useRef, useState } from 'react';
import Dice from 'react-dice-roll';
import { toast } from 'react-toastify';

type TPage = PageProps<{ game: App.Data.Game.GameData }>;

const diceId = 'dice';

export default function RollTheDice() {
  const { game } = usePage<TPage>().props;
  const [hasStarted, setHasStarted] = useState(false);
  const [currentTurn, setCurrentTurn] = useState<'bot' | 'user'>('user');
  const currentTurnRef = useRef('user');
  const [winner, setWinner] = useState<'bot' | 'user' | null>(null);
  const [scores, setScores] = useState({ user: 0, bot: 0 });
  const isCurrentTurnLegit = currentTurn === currentTurnRef.current;

  useEffect(() => {
    if (winner === 'user') {
      toast.success('شما برنده بازی شدید.');
    }
  }, [winner]);

  const handleRoll = (value: number) => {
    if (currentTurn === 'bot') {
      const newScore = value + scores.bot;
      setScores({ ...scores, bot: newScore });
      if (newScore >= 30) setWinner('bot');
      return;
    }
    const newScore = value + scores.user;
    setScores({ ...scores, user: newScore });
    if (newScore >= 30) {
      setWinner('user');
      return;
    }
    currentTurnRef.current = 'bot';
    setTimeout(() => setCurrentTurn('bot'), 2_000);
  };

  useEffect(() => {
    const dice = document.getElementById(diceId)?.firstChild as HTMLButtonElement | null;
    if (dice && currentTurn === 'bot') {
      dice.click();
      currentTurnRef.current = 'user';
      setTimeout(() => setCurrentTurn('user'), 2_000);
    }
  }, [currentTurn]);

  return (
    <div className="mt-page space-y container">
      <Head
        canonicalUrl={route('games.roll-the-dice')}
        title={game.title}
        description={game.title}
        imageUrl={game.image}
      />
      <BreadCrumb
        links={[
          { title: 'بازی ها', href: route('games.index') },
          { title: game.title, href: '#' },
        ]}
      />
      <div className="space-y-4">
        <h1 className="h1">{game.title}</h1>
        <p className="text-base-content/80">{game.short_description}</p>
      </div>
      <div className="card bg-base-200 px-4 py-10">
        <div className="card-body">
          <div className="flex w-full flex-col items-center justify-between gap-8 md:flex-row">
            <div className="flex flex-col items-center justify-center gap-4">
              <Image width={180} height={180} alt="پروفایل حجاب" src="/svg/hijab.svg" />
              <span
                className={cn('h2 rounded-box bg-base-100 px-4 py-2 font-fa-display', {
                  'bg-primary': isCurrentTurnLegit && currentTurn === 'user',
                })}
              >
                {digitsEnToFa(scores.user)}
              </span>
            </div>
            <Starter onStart={() => setHasStarted(true)} />
            {hasStarted && !winner && (
              <div
                id={diceId}
                className={cn('space-y-4', {
                  'tooltip tooltip-top tooltip-open animate-bounce': currentTurn === 'user',
                })}
                data-tip="لطفا روی تاس کلیک کنید"
              >
                <Dice disabled={!isCurrentTurnLegit} onRoll={handleRoll} size={100} />
              </div>
            )}
            {winner && (
              <motion.div
                initial={{ opacity: 0, scale: 3, rotate: -180 }}
                animate={{ opacity: 1, scale: 1, rotate: 0 }}
                className="block text-center font-fa-display text-4xl"
              >
                <span className="text-primary-solo">{winner === 'user' ? 'شما' : 'ربات'}</span>
                {` ${winner === 'user' ? 'برنده شدید!' : 'برنده شد!'}`}
              </motion.div>
            )}
            <div className="flex flex-col items-center justify-center gap-4">
              <Image src="/svg/robot.svg" width={200} height={200} alt="ربات" />
              <span
                className={cn('h2 rounded-box bg-base-100 px-4 py-2 font-fa-display', {
                  'bg-primary': currentTurn === 'bot',
                })}
              >
                {digitsEnToFa(scores.bot)}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
