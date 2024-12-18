import { GoDotFill } from 'react-icons/go';

type FaqsProps = {
  faqs: App.Data.Series.SeriesFaqData[] | undefined | null;
};

export default function Faqs({ faqs }: FaqsProps) {
  if (!faqs || faqs.length <= 0) return null;

  return (
    <>
      <div className="divider" />
      <div className="flex items-center justify-center gap-2 md:justify-start">
        <GoDotFill className="hidden size-4 md:block" />
        <h2 className="h2 text-base-content md:text-start">سوالات متداول</h2>
      </div>
      {faqs.map((faq, i) => (
        <div
          key={i}
          tabIndex={0}
          className="collapse collapse-arrow border border-base-300 bg-base-300"
        >
          <div className="text-md collapse-title font-medium">{faq.title}</div>
          <div className="collapse-content text-base-content/80">
            <p>{faq.description}</p>
          </div>
        </div>
      ))}
    </>
  );
}
