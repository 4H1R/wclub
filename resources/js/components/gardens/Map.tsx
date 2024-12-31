import { LatLngExpression } from 'leaflet';
import 'leaflet/dist/leaflet.css';
import { MapContainer, Marker, TileLayer } from 'react-leaflet';

type MapProps = {
  longitude: number;
  latitude: number;
};

export default function Map({ latitude, longitude }: MapProps) {
  const position: LatLngExpression = [latitude, longitude];

  return (
    <MapContainer
      fadeAnimation
      className="h-64 w-full"
      center={position}
      zoom={16}
      scrollWheelZoom={false}
      attributionControl={false}
      zoomControl
    >
      <TileLayer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" />
      <Marker position={position} />
    </MapContainer>
  );
}
