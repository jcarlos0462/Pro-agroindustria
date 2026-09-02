import React, { useState, useMemo } from 'react';
import { Card, Title, Text, BarChart, Subtitle } from '@tremor/react';
import { 
    CalendarIcon, 
    ArrowLeftIcon, 
    FunnelIcon, 
    ArrowDownTrayIcon 
} from '@heroicons/react/24/outline';

// --- TIPOS DE DATOS ---
interface TonnageData {
    date: string;
    scale: number;
    burreo: number;
    total: number;
}

interface DetailData {
    id: string;
    supplier: string;
    type: 'scale' | 'burreo';
    weight: number;
}

interface DashboardProps {
    charts: {
        daily_tonnage: TonnageData[];
    };
    detailsData?: Record<string, DetailData[]>;
}

export const TonnageDashboard: React.FC<DashboardProps> = ({ 
    charts, 
    detailsData = {} 
}) => {
    // --- ESTADOS ---
    const [viewMode, setViewMode] = useState<'all' | 'scale' | 'burreo'>('all');
    const [drillLevel, setDrillLevel] = useState<number>(0);
    const [selectedDate, setSelectedDate] = useState<string | null>(null);

    // --- MANEJO DE CATEGORÍAS Y COLORES SEGÚN EL FILTRO ---
    const categories = useMemo(() => {
        if (viewMode === 'scale') return ['scale'];
        if (viewMode === 'burreo') return ['burreo'];
        return ['total']; // En modo "all", mostramos el consolidado para evitar barras superpuestas/divididas
    }, [viewMode]);

    const colors = useMemo(() => {
        if (viewMode === 'scale') return ['blue'];
        if (viewMode === 'burreo') return ['amber'];
        return ['indigo'];
    }, [viewMode]);

    // --- CONTROLADORES DE EVENTOS ---
    const handleBarClick = (v: any) => {
        if (!v || !v.activePayload || v.activePayload.length === 0) return;
        const clickedData = v.activePayload[0].payload;
        if (clickedData && clickedData.date) {
            setSelectedDate(clickedData.date);
            setDrillLevel(1);
        }
    };

    const handleBack = () => {
        setDrillLevel(0);
        setSelectedDate(null);
    };

    // --- DATOS DEL NIVEL DE DETALLE (DRILLDOWN) ---
    const currentDetails = useMemo(() => {
        if (!selectedDate || !detailsData[selectedDate]) return [];
        const rawList = detailsData[selectedDate];
        if (viewMode === 'all') return rawList;
        return rawList.filter((item) => item.type === viewMode);
    }, [selectedDate, detailsData, viewMode]);

    return (
        <Card className="w-full max-w-5xl mx-auto shadow-md rounded-xl border border-gray-100 p-6">
            {/* ENCABEZADO Y CONTROLES */}
            <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div>
                    <div className="flex items-center gap-2">
                        {drillLevel > 0 && (
                            <button
                                onClick={handleBack}
                                className="p-1.5 rounded-lg border border-gray-200 hover:bg-gray-50 text-gray-600 transition-colors"
                                title="Volver al gráfico"
                            >
                                <ArrowLeftIcon className="w-5 h-5" />
                            </button>
                        )}
                        <Title className="text-xl font-bold text-gray-800">
                            {drillLevel === 0 
                                ? 'Tonelaje Diario Consolidado' 
                                : `Detalle del día: ${selectedDate}`}
                        </Title>
                    </div>
                    <Subtitle className="text-xs text-gray-500 mt-1">
                        {drillLevel === 0 
                            ? 'Monitoreo de ingresos de báscula y burreo' 
                            : 'Desglose detallado por proveedor e ingreso'}
                    </Subtitle>
                </div>

                {/* FILTROS DE MODO DE VISTA */}
                <div className="flex items-center gap-1.5 bg-gray-100 p-1 rounded-lg">
                    <button
                        onClick={() => setViewMode('all')}
                        className={`px-3 py-1.5 text-xs font-semibold rounded-md transition-all ${
                            viewMode === 'all'
                                ? 'bg-white text-indigo-600 shadow-sm'
                                : 'text-gray-600 hover:text-gray-900'
                        }`}
                    >
                        Todos
                    </button>
                    <button
                        onClick={() => setViewMode('scale')}
                        className={`px-3 py-1.5 text-xs font-semibold rounded-md transition-all ${
                            viewMode === 'scale'
                                ? 'bg-white text-blue-600 shadow-sm'
                                : 'text-gray-600 hover:text-gray-900'
                        }`}
                    >
                        Báscula
                    </button>
                    <button
                        onClick={() => setViewMode('burreo')}
                        className={`px-3 py-1.5 text-xs font-semibold rounded-md transition-all ${
                            viewMode === 'burreo'
                                ? 'bg-white text-amber-600 shadow-sm'
                                : 'text-gray-600 hover:text-gray-900'
                        }`}
                    >
                        Burreo
                    </button>
                </div>
            </div>

            {/* CONTENIDO PRINCIPAL: NIVEL 0 (GRÁFICA) O NIVEL 1 (DETALLE) */}
            {drillLevel === 0 ? (
                <div className="h-full">
                    <BarChart
                        className="h-80"
                        data={charts.daily_tonnage}
                        index="date"
                        categories={categories}
                        colors={colors}
                        valueFormatter={(val: number) =>
                            `${(val / 1000).toLocaleString(undefined, {
                                minimumFractionDigits: 3,
                                maximumFractionDigits: 3,
                            })} TM`
                        }
                        showAnimation={true}
                        showLegend={false}
                        yAxisWidth={70}
                        stack={false}
                        onValueChange={(v: any) => handleBarClick(v)}
                    />
                    <p className="text-center text-[10px] text-gray-400 font-bold uppercase mt-4 animate-pulse">
                        💡 Haz clic en una barra para ver detalles
                    </p>
                </div>
            ) : (
                <div className="mt-4">
                    {currentDetails.length === 0 ? (
                        <div className="py-12 text-center text-gray-400 text-sm">
                            No hay registros disponibles para el filtro seleccionado en esta fecha.
                        </div>
                    ) : (
                        <div className="overflow-x-auto border border-gray-100 rounded-lg">
                            <table className="w-full text-sm text-left text-gray-600">
                                <thead className="bg-gray-50 text-xs uppercase text-gray-500 border-b border-gray-100">
                                    <tr>
                                        <th className="px-4 py-3">ID Reg.</th>
                                        <th className="px-4 py-3">Proveedor</th>
                                        <th className="px-4 py-3">Tipo</th>
                                        <th className="px-4 py-3 text-right">Peso (TM)</th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-gray-100">
                                    {currentDetails.map((row) => (
                                        <tr key={row.id} className="hover:bg-gray-50/50">
                                            <td className="px-4 py-3 font-medium text-gray-900">{row.id}</td>
                                            <td className="px-4 py-3">{row.supplier}</td>
                                            <td className="px-4 py-3">
                                                <span className={`inline-flex items-center px-2 py-0.5 rounded text-xs font-medium capitalize ${
                                                    row.type === 'scale' 
                                                        ? 'bg-blue-50 text-blue-700' 
                                                        : 'bg-amber-50 text-amber-700'
                                                }`}>
                                                    {row.type}
                                                </span>
                                            </td>
                                            <td className="px-4 py-3 text-right font-semibold text-gray-900">
                                                {(row.weight / 1000).toFixed(3)} TM
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    )}
                </div>
            )}
        </Card>
    );
};

export default TonnageDashboard;
