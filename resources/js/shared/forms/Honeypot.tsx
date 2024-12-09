import { THoneypot } from '@/types';
import { InputLists } from './Input';

type HoneyPotProps = {
  honeypot: THoneypot;
};

export default function HoneyPot({ honeypot }: HoneyPotProps) {
  if (!honeypot.enabled) return null;

  return (
    <div className="hidden">
      <InputLists
        fields={[
          {
            isRequired: true,
            label: { text: honeypot.nameFieldName },
            name: honeypot.nameFieldName,
          },
          {
            isRequired: true,
            label: { text: honeypot.validFromFieldName },
            name: honeypot.validFromFieldName,
          },
        ]}
      />
    </div>
  );
}
