import Button from '@/shared/forms/Button';
import Head from '@/shared/Head';
import Modal from '@/shared/modals/Modal';
import { TIcon } from '@/types';
import { closeModal, cn, openModal } from '@/utils';
import { motion } from 'framer-motion';
import { useEffect, useRef, useState } from 'react';
import {
  HiChevronDoubleUp,
  HiOutlineFilm,
  HiOutlineNewspaper,
  HiOutlinePaperAirplane,
  HiOutlineSignal,
  HiOutlineStar,
  HiOutlineTrophy,
  HiOutlineXMark,
  HiPlayCircle,
} from 'react-icons/hi2';

type TSection = {
  title: string;
  name: string;
  Icon: TIcon;
};

const sections: TSection[] = [
  {
    title: 'خدمات',
    name: 'rewardPrograms',
    Icon: HiOutlineStar,
  },
  {
    title: 'رویداد ها',
    name: 'eventPrograms',
    Icon: HiOutlineSignal,
  },
  {
    title: 'چالش ها و مسابقات',
    name: 'contests',
    Icon: HiOutlineTrophy,
  },
  {
    title: 'اخبار',
    name: 'news',
    Icon: HiOutlineNewspaper,
  },
  {
    title: 'دوره ها',
    name: 'series',
    Icon: HiOutlineFilm,
  },
  {
    title: 'بازی ها',
    name: 'games',
    Icon: HiPlayCircle,
  },
];

const modalId = 'chatbotModal';

type TText = {
  id: string;
  body: string;
  sender: 'user' | 'bot';
};

export default function Chatbot() {
  const [activeSection, setActiveSection] = useState<null | string>(null);
  const [texts, setTexts] = useState<TText[]>([]);
  const [text, setText] = useState('');
  const [isMaximized, setIsMaximized] = useState(false);
  const [isBotThinking, setIsBotThinking] = useState(false);
  const currentSection = sections.find((section) => section.name === activeSection);
  const lastMessageRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    lastMessageRef.current?.scrollIntoView({ behavior: 'smooth' });
  }, [texts]);

  const handleSelectSection = (section: TSection) => {
    setActiveSection(section.name);
    setTexts((prev) => [
      ...prev,
      {
        id: new Date().toISOString(),
        body: `سلام چه سوالی در مورد ${section.title} داری؟`,
        sender: 'bot',
      },
    ]);
    openModal(modalId);
  };

  const handleAnswerAsBot = () => {
    setIsBotThinking(true);
    setTimeout(() => {
      setTexts((prev) => [
        ...prev,
        {
          id: new Date().toISOString(),
          body: 'چت بات در حال توسعه است',
          sender: 'bot',
        },
      ]);
      setIsBotThinking(false);
    }, 1000);
  };

  const handleCloseModal = () => {
    closeModal(modalId);
    setActiveSection(null);
    setText('');
  };

  const handleSendText = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    if (!text.trim()) return;
    setTexts((prev) => [...prev, { id: new Date().toISOString(), body: text, sender: 'user' }]);
    setText('');
    handleAnswerAsBot();
  };

  return (
    <div className="space-y mt-page container">
      <Head title="چت بات هوشمند" description="چت بات هوشمند" />
      <div className="space-y-4 text-center">
        <h1 className="h1 text-base-content">چت بات هوشمند</h1>
        <p className="text-base-content/80">
          شما میتوانید هر سوالی که دارید را از چت بات هوشمند بپرسید لطفا یکی از دسته بندی های زیر را
          انتخاب کنید
        </p>
      </div>
      <ul className="flex flex-wrap items-center justify-center gap-4">
        {sections.map((section) => (
          <li key={section.name}>
            <Button onClick={() => handleSelectSection(section)} className="btn btn-outline flex">
              <section.Icon className="size-6" />
              <span>{section.title}</span>
            </Button>
          </li>
        ))}
      </ul>
      <Modal
        closeOnClickOutside
        id={modalId}
        parentElement="div"
        dialogClassName="modal-bottom"
        parentClassName={cn('h-3/4 overflow-y-hidden', {
          'h-full min-h-screen rounded-none': isMaximized,
        })}
      >
        <div className="flex items-center justify-between">
          <h3 className="h3">{currentSection?.title}</h3>
          <div className="flex items-center gap-4">
            <Button
              onClick={() => setIsMaximized(!isMaximized)}
              className={cn('btn btn-circle btn-sm transition-transform', {
                'rotate-180': isMaximized,
              })}
            >
              <HiChevronDoubleUp className="size-6" />
            </Button>
            <Button onClick={handleCloseModal} className="btn btn-circle btn-sm">
              <HiOutlineXMark className="size-6" />
            </Button>
          </div>
        </div>
        <div className="card card-compact h-[93%] bg-base-200">
          <div className="card-body relative overflow-y-auto !p-0 !pt-2">
            {texts.map((text) => (
              <motion.div
                initial={{ opacity: 0, top: -300 }}
                animate={{ opacity: 1, top: 0 }}
                key={text.id}
                className={cn('chat chat-start', { 'chat-end': text.sender === 'bot' })}
              >
                <div
                  className={cn('chat-bubble chat-bubble-primary', {
                    'bg-base-300 text-base-content': text.sender === 'bot',
                  })}
                >
                  {text.body}
                </div>
              </motion.div>
            ))}
            {isBotThinking && (
              <motion.div
                initial={{ opacity: 0, top: -300 }}
                animate={{ opacity: 1, top: 0 }}
                className="chat chat-end"
                ref={lastMessageRef}
              >
                <div className="chat-bubble bg-base-300 text-base-content">
                  <div className="loading loading-dots" />
                </div>
              </motion.div>
            )}
            <div ref={lastMessageRef} className="hidden" />
            <div className="h-full" />
            <form
              className="join sticky -bottom-0 right-0 w-full bg-base-100"
              onSubmit={handleSendText}
            >
              <Button
                type="submit"
                disabled={!text || isBotThinking}
                className="btn btn-primary join-item"
              >
                <HiOutlinePaperAirplane className="size-6" />
              </Button>
              <input
                onChange={(e) => setText(e.target.value)}
                value={text}
                disabled={isBotThinking}
                type="text"
                className="input join-item input-bordered w-full focus:ring-0 disabled:bg-base-100"
              />
            </form>
          </div>
        </div>
      </Modal>
    </div>
  );
}
