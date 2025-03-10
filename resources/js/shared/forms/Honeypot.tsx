import { InputLists } from './Input';

type HoneyPotProps = {
  honeypot: App.Data.Honeypot.HoneypotData;
};

export default function HoneyPot({ honeypot }: HoneyPotProps) {
  if (!honeypot.enabled) return null;

  return (
    <div className="hidden">
      <InputLists
        fields={[
          {
            isRequired: true,
            label: { text: honeypot.name_field_name },
            name: honeypot.name_field_name,
          },
          {
            isRequired: true,
            label: { text: honeypot.valid_from_field_name },
            name: honeypot.valid_from_field_name,
          },
        ]}
      />
    </div>
  );
}
