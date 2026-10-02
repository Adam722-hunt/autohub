<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAspirationRequest;
use App\Http\Requests\StoreBodyTypeRequest;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\StoreConditionRequest;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\StoreDrivetrainRequest;
use App\Http\Requests\StoreEngineCylinderRequest;
use App\Http\Requests\StoreEngineLayoutRequest;
use App\Http\Requests\StoreFeatureCategoryRequest;
use App\Http\Requests\StoreFeatureRequest;
use App\Http\Requests\StoreFuelTypeRequest;
use App\Http\Requests\StoreTransmissionRequest;
use App\Http\Requests\StoreVehicleGenerationRequest;
use App\Http\Requests\StoreVehicleModelRequest;
use App\Http\Requests\StoreVehicleTypeRequest;
use App\Http\Requests\UpdateAspirationRequest;
use App\Http\Requests\UpdateBodyTypeRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Http\Requests\UpdateColorRequest;
use App\Http\Requests\UpdateConditionRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Http\Requests\UpdateDrivetrainRequest;
use App\Http\Requests\UpdateEngineCylinderRequest;
use App\Http\Requests\UpdateEngineLayoutRequest;
use App\Http\Requests\UpdateFeatureCategoryRequest;
use App\Http\Requests\UpdateFeatureRequest;
use App\Http\Requests\UpdateFuelTypeRequest;
use App\Http\Requests\UpdateTransmissionRequest;
use App\Http\Requests\UpdateVehicleGenerationRequest;
use App\Http\Requests\UpdateVehicleModelRequest;
use App\Http\Requests\UpdateVehicleTypeRequest;
use App\Models\AspirationType;
use App\Models\BodyType;
use App\Models\Brand;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\DriveTrainType;
use App\Models\EngineCyl;
use App\Models\EngineLayout;
use App\Models\Feature;
use App\Models\FeatureCat;
use App\Models\FuelType;
use App\Models\TransmissionType;
use App\Models\VehicleColor;
use App\Models\VehicleCondition;
use App\Models\VehicleGen;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminLookupController extends Controller
{
    public function brands(Request $request)
    {

        $query = Brand::with('vehicleType:id,name')->withCount('vehicles');
        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%');
        });
        $brands = $query->orderBy('name', 'asc')->paginate(15);
        return response()->json([
            'brands' => $brands
        ]);
    }

    public function storeBrand(StoreBrandRequest $request)
    {

        $data = $request->validated();
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('brands', 'public');
        }
        Brand::create($data);
        return response()->json([
            'message' => 'Brand created successfully'
        ], 201);
    }

    public function updateBrand(UpdateBrandRequest $request, Brand $brand)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            if ($brand->logo && Storage::disk('public')->exists($brand->logo)) {
                Storage::disk('public')->delete($brand->logo);
            }
            $data['logo'] = $request->file('logo')->store('brands', 'public');
        }
        $brand->update($data);
        return response()->json([
            'message' => 'Brand updated successfully'
        ], 200);
    }

    public function deleteBrand(Brand $brand)
    {
        if ($brand->vehicles()->exists()) {
            return response()->json([
                'message' => 'Cannot delete brand because it is used by vehicles'
            ], 409);
        }
        if ($brand->vehicleModels()->exists()) {
            return response()->json([
                'message' => 'Cannot delete brand because it has vehicle models'
            ], 409);
        }
        if ($brand->logo && Storage::disk('public')->exists($brand->logo)) {
            Storage::disk('public')->delete($brand->logo);
        }
        $brand->delete();
        return response()->json([
            'message' => 'Brand deleted successfully'
        ], 200);
    }

    public function models(Request $request)
    {
        $query = VehicleModel::with('brand:id,name')->withCount('vehicles');
        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'ILIKE', '%' . $request->search . '%')
                    ->orWhereHas('brand', function ($query) use ($request) {
                        $query->where('name', 'ILIKE', '%' . $request->search . '%');
                    });
            });
        });
        $models = $query->orderBy('updated_at', 'desc')->paginate(15);
        return response()->json([
            'models' => $models,
        ], 200);
    }

    public function storeModel(StoreVehicleModelRequest $request)
    {
        VehicleModel::create($request->validated());
        return response()->json([
            'message' => 'Model added successfully'
        ], 201);
    }

    public function updateModel(UpdateVehicleModelRequest $request, VehicleModel $vehicleModel)
    {
        $vehicleModel->update($request->validated());
        return response()->json([
            'message' => 'Model updated successfully'
        ], 200);
    }

    public function deleteModel(VehicleModel $model)
    {
        if ($model->vehicles()->exists()) {
            return response()->json([
                'message' => 'Cannot delete model because it is used by vehicles'
            ], 409);
        }
        $model->delete();
        return response()->json([
            'message' => 'Model deleted successfully'
        ], 200);
    }

    public function vehicleTypes(Request $request)
    {
        $query = VehicleType::withCount('vehicles');
        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%');
        });
        $vehicleTypes = $query->get();
        return response()->json([
            'vehicle_types' => $vehicleTypes
        ], 200);
    }

    public function storeVehicleType(StoreVehicleTypeRequest $request)
    {

        VehicleType::create($request->validated());
        return response()->json([
            'message' => 'Vehicle type added successfully'
        ], 201);
    }

    public function updateVehicleType(UpdateVehicleTypeRequest $request, VehicleType $vehicleType)
    {
        $vehicleType->update($request->validated());
        return response()->json([
            'message' => 'Vehicle type updated successfully'
        ], 200);
    }

    public function deleteVehicleType(VehicleType $vehicleType)
    {
        if ($vehicleType->vehicles()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this vehicle type because it is used by vehicles'
            ], 409);
        }
        if ($vehicleType->brands()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this vehicle type because it is used by brands'
            ], 409);
        }
        $vehicleType->delete();
        return response()->json([
            'message' => 'Vehicle type deleted successfully'
        ], 200);
    }

    public function fuelTypes(Request $request)
    {
        $query = FuelType::withCount('vehicles');
        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%');
        });
        $fuelTypes = $query->get();
        return response()->json([
            'fuel_types' => $fuelTypes
        ], 200);
    }

    public function storeFuelType(StoreFuelTypeRequest $request)
    {
        FuelType::create($request->validated());
        return response()->json([
            'message' => 'Fuel type added successfully'
        ], 201);
    }

    public function updateFuelType(UpdateFuelTypeRequest $request, FuelType $fuelType)
    {
        $fuelType->update($request->validated());
        return response()->json([
            'message' => 'Fuel type updated successfully'
        ], 200);
    }

    public function deleteFuelType(FuelType $fuelType)
    {
        if ($fuelType->vehicles()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this fuel type because it is in use by vehicles'
            ], 409);
        }
        $fuelType->delete();
        return response()->json([
            'message' => 'Fuel type deleted successfully'
        ], 200);
    }

    public function transmissions(Request $request)
    {
        $query = TransmissionType::withCount('vehicles');
        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%');
        });
        $transmissions = $query->get();
        return response()->json([
            'transmissions' => $transmissions,
        ], 200);
    }

    public function storeTransmission(StoreTransmissionRequest $request)
    {
        TransmissionType::create($request->validated());
        return response()->json([
            'message' => 'Transmission type added successfully'
        ], 201);
    }

    public function updateTransmission(UpdateTransmissionRequest $request, TransmissionType $transmission)
    {
        $transmission->update($request->validated());
        return response()->json([
            'message' => 'Transmission type updated successfully'
        ], 200);
    }

    public function deleteTransmission(TransmissionType $transmission)
    {
        if ($transmission->vehicles()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this transmission type because it is in use by vehicles'
            ], 409);
        }
        $transmission->delete();
        return response()->json([
            'message' => 'Transmission type deleted successfully'
        ], 200);
    }

    public function drivetrains(Request $request)
    {
        $query = DriveTrainType::withCount('vehicles');
        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%');
        });
        $drivetrains = $query->get();
        return response()->json([
            'drive_trains' => $drivetrains
        ], 200);
    }

    public function storeDrivetrain(StoreDrivetrainRequest $request)
    {
        DriveTrainType::create($request->validated());
        return response()->json([
            'message' => 'Drive train type added successfully'
        ], 201);
    }

    public function updateDrivetrain(UpdateDrivetrainRequest $request, DriveTrainType $drivetrain)
    {
        $drivetrain->update($request->validated());
        return response()->json([
            'message' => 'Drivetrain type updated successfully'
        ], 200);
    }

    public function deleteDrivetrain(DriveTrainType $drivetrain)
    {
        if ($drivetrain->vehicles()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this drivetrain type because it is in use by vehicles'
            ], 409);
        }
        $drivetrain->delete();
        return response()->json([
            'message' => 'Drivetrain type deleted successfully'
        ], 200);
    }

    public function bodyTypes(Request $request)
    {
        $query = BodyType::withCount('vehicles');

        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%');
        });

        $bodyTypes = $query->get();

        return response()->json([
            'body_types' => $bodyTypes
        ], 200);
    }

    public function storeBodyType(StoreBodyTypeRequest $request)
    {
        BodyType::create($request->validated());

        return response()->json([
            'message' => 'Body type added successfully'
        ], 201);
    }

    public function updateBodyType(UpdateBodyTypeRequest $request, BodyType $bodyType)
    {
        $bodyType->update($request->validated());

        return response()->json([
            'message' => 'Body type updated successfully'
        ], 200);
    }

    public function deleteBodyType(BodyType $bodyType)
    {
        if ($bodyType->vehicles()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this body type because it is in use by vehicles'
            ], 409);
        }

        $bodyType->delete();

        return response()->json([
            'message' => 'Body type deleted successfully'
        ], 200);
    }

    public function colors(Request $request)
    {
        $query = VehicleColor::withCount('vehicles');

        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%');
        });

        $colors = $query->get();

        return response()->json([
            'colors' => $colors
        ], 200);
    }

    public function storeColor(StoreColorRequest $request)
    {
        VehicleColor::create($request->validated());

        return response()->json([
            'message' => 'Color added successfully'
        ], 201);
    }

    public function updateColor(UpdateColorRequest $request, VehicleColor $color)
    {
        $color->update($request->validated());

        return response()->json([
            'message' => 'Color updated successfully'
        ], 200);
    }

    public function deleteColor(VehicleColor $color)
    {
        if ($color->vehicles()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this color because it is in use by vehicles'
            ], 409);
        }

        $color->delete();

        return response()->json([
            'message' => 'Color deleted successfully'
        ], 200);
    }

    public function conditions(Request $request)
    {
        $query = VehicleCondition::withCount('vehicles');

        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%');
        });

        $conditions = $query->get();

        return response()->json([
            'conditions' => $conditions
        ], 200);
    }

    public function storeCondition(StoreConditionRequest $request)
    {
        VehicleCondition::create($request->validated());

        return response()->json([
            'message' => 'Condition added successfully'
        ], 201);
    }

    public function updateCondition(UpdateConditionRequest $request, VehicleCondition $condition)
    {
        $condition->update($request->validated());

        return response()->json([
            'message' => 'Condition updated successfully'
        ], 200);
    }

    public function deleteCondition(VehicleCondition $condition)
    {
        if ($condition->vehicles()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this condition because it is in use by vehicles'
            ], 409);
        }

        $condition->delete();

        return response()->json([
            'message' => 'Condition deleted successfully'
        ], 200);
    }
    public function engineCylinders(Request $request)
    {
        $query = EngineCyl::withCount('vehicles');

        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%');
        });

        $engineCylinders = $query->get();

        return response()->json([
            'engine_cylinders' => $engineCylinders
        ], 200);
    }

    public function storeEngineCylinder(StoreEngineCylinderRequest $request)
    {
        EngineCyl::create($request->validated());

        return response()->json([
            'message' => 'Engine cylinder added successfully'
        ], 201);
    }

    public function updateEngineCylinder(
        UpdateEngineCylinderRequest $request,
        EngineCyl $engineCylinder
    ) {
        $engineCylinder->update($request->validated());

        return response()->json([
            'message' => 'Engine cylinder updated successfully'
        ], 200);
    }

    public function deleteEngineCylinder(EngineCyl $engineCylinder)
    {
        if ($engineCylinder->vehicles()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this engine cylinder because it is in use by vehicles'
            ], 409);
        }

        $engineCylinder->delete();

        return response()->json([
            'message' => 'Engine cylinder deleted successfully'
        ], 200);
    }

    public function engineLayouts(Request $request)
    {
        $query = EngineLayout::withCount('vehicles');

        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%');
        });

        $engineLayouts = $query->get();

        return response()->json([
            'engine_layouts' => $engineLayouts
        ], 200);
    }

    public function storeEngineLayout(StoreEngineLayoutRequest $request)
    {
        EngineLayout::create($request->validated());

        return response()->json([
            'message' => 'Engine layout added successfully'
        ], 201);
    }

    public function updateEngineLayout(
        UpdateEngineLayoutRequest $request,
        EngineLayout $engineLayout
    ) {
        $engineLayout->update($request->validated());

        return response()->json([
            'message' => 'Engine layout updated successfully'
        ], 200);
    }

    public function deleteEngineLayout(EngineLayout $engineLayout)
    {
        if ($engineLayout->vehicles()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this engine layout because it is in use by vehicles'
            ], 409);
        }

        $engineLayout->delete();

        return response()->json([
            'message' => 'Engine layout deleted successfully'
        ], 200);
    }

    public function aspirations(Request $request)
    {
        $query = AspirationType::withCount('vehicles');

        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%');
        });

        $aspirations = $query->get();

        return response()->json([
            'aspirations' => $aspirations
        ], 200);
    }

    public function storeAspiration(StoreAspirationRequest $request)
    {
        AspirationType::create($request->validated());

        return response()->json([
            'message' => 'Aspiration added successfully'
        ], 201);
    }

    public function updateAspiration(
        UpdateAspirationRequest $request,
        AspirationType $aspiration
    ) {
        $aspiration->update($request->validated());

        return response()->json([
            'message' => 'Aspiration updated successfully'
        ], 200);
    }

    public function deleteAspiration(AspirationType $aspiration)
    {
        if ($aspiration->vehicles()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this aspiration because it is in use by vehicles'
            ], 409);
        }

        $aspiration->delete();

        return response()->json([
            'message' => 'Aspiration deleted successfully'
        ], 200);
    }

    public function generations(Request $request)
    {
        $query = VehicleGen::with(['vehicleModel:id,name'])->withCount('vehicles');
        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%')
                ->orWhereHas('vehicleModel', function ($query) use ($request) {
                    $query->where('name', 'ILIKE', '%' . $request->search . '%');
                });
        });
        $generations = $query->orderBy('updated_at', 'desc')->paginate(15);

        return response()->json([
            'generations' => $generations
        ], 200);
    }

    public function storeGeneration(StoreVehicleGenerationRequest $request)
    {
        VehicleGen::create($request->validated());
        return response()->json([
            'message' => 'Vehicle generation added successfully'
        ], 201);
    }

    public function updateGeneration(UpdateVehicleGenerationRequest $request, VehicleGen $vehicleGen)
    {
        $vehicleGen->update($request->validated());
        return response()->json([
            'message' => 'Vehicle generation updated successfully'
        ], 200);
    }

    public function deleteGeneration(VehicleGen $vehicleGen)
    {
        if ($vehicleGen->vehicles()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this vehicle generation because it is in use by vehicles'
            ], 409);
        }

        $vehicleGen->delete();
        return response()->json([
            'message' => 'Vehicle generation deleted successfully'
        ], 200);
    }

    public function countries(Request $request)
    {
        $query = Country::withCount('users', 'vehicles', 'cities');
        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%');
        });
        $countries = $query->orderBy('name', 'asc')->paginate(15);

        return response()->json([
            'countries' => $countries
        ], 200);
    }

    public function storeCountry(StoreCountryRequest $request)
    {
        Country::create($request->validated());
        return response()->json([
            'message' => 'Country added successfully'
        ], 201);
    }

    public function updateCountry(UpdateCountryRequest $request, Country $country)
    {
        $country->update($request->validated());

        return response()->json([
            'message' => 'Country updated successfully'
        ], 200);
    }

    public function deleteCountry(Country $country)
    {
        if ($country->users()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this country because it is in use by users'
            ], 409);
        }
        if ($country->vehicles()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this country because it is in use by vehicles'
            ], 409);
        }
        if ($country->cities()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this country because it is in use by cities'
            ], 409);
        }
        $country->delete();
        return response()->json([
            'message' => 'Country deleted successfully'
        ], 200);
    }

    public function cities(Request $request)
    {
        $query = City::with(['country:id,name'])
            ->withCount('users', 'vehicles');

        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%')
                ->orWhereHas('country', function ($query) use ($request) {
                    $query->where('name', 'ILIKE', '%' . $request->search . '%');
                });
        });

        $cities = $query->orderBy('name', 'asc')->paginate(15);

        return response()->json([
            'cities' => $cities
        ], 200);
    }

    public function storeCity(StoreCityRequest $request)
    {
        City::create($request->validated());
        return response()->json([
            'message' => 'City added successfully'
        ], 201);
    }

    public function updateCity(UpdateCityRequest $request, City $city)
    {
        $city->update($request->validated());
        return response()->json([
            'message' => 'City updated successfully'
        ], 200);
    }

    public function deleteCity(City $city)
    {
        if ($city->users()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this city because it is in use by users'
            ], 409);
        }

        if ($city->vehicles()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this city because it is in use by vehicles'
            ], 409);
        }

        $city->delete();

        return response()->json([
            'message' => 'City deleted successfully'
        ], 200);
    }

    public function currencies(Request $request)
    {
        $query = Currency::withCount('preferences');
        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%')
                ->orWhere('code', 'ILIKE', '%' . $request->search . '%');
        });

        $currencies = $query->orderBy('name', 'asc')->paginate(15);

        return response()->json([
            'currencies' => $currencies
        ], 200);
    }

    public function storeCurrency(StoreCurrencyRequest $request)
    {
        Currency::create($request->validated());
        return response()->json([
            'message' => 'Currency added successfully'
        ], 201);
    }

    public function updateCurrency(UpdateCurrencyRequest $request, Currency $currency)
    {
        $currency->update($request->validated());
        return response()->json([
            'message' => 'Currency updated successfully'
        ], 200);
    }

    public function deleteCurrency(Currency $currency)
    {
        if ($currency->vehicles()->exists()) {
            return response()->json([
                'message' => 'Cannot delete currency because it is in use by vehicles'
            ], 409);
        }

        if ($currency->preferences()->exists()) {
            return response()->json([
                'message' => 'Cannot delete currency because it is in users preferences'
            ], 409);
        }

        $currency->delete();

        return response()->json([
            'message' => 'Currency deleted successfully'
        ], 200);
    }

    public function featureCategories(Request $request)
    {
        $query = FeatureCat::withCount('features');

        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%');
        });

        $featureCategories = $query
            ->orderBy('name', 'asc')
            ->paginate(15);

        return response()->json([
            'feature_categories' => $featureCategories
        ], 200);
    }

    public function storeFeatureCategory(StoreFeatureCategoryRequest $request)
    {
        FeatureCat::create($request->validated());

        return response()->json([
            'message' => 'Feature category added successfully'
        ], 201);
    }

    public function updateFeatureCategory(
        UpdateFeatureCategoryRequest $request,
        FeatureCat $featureCat
    ) {
        $featureCat->update($request->validated());

        return response()->json([
            'message' => 'Feature category updated successfully'
        ], 200);
    }

    public function deleteFeatureCategory(FeatureCat $featureCat)
    {
        if ($featureCat->features()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this feature category because it is in use by features'
            ], 409);
        }

        $featureCat->delete();

        return response()->json([
            'message' => 'Feature category deleted successfully'
        ], 200);
    }

    public function features(Request $request)
    {
        $query = Feature::with('featureCat:id,name')
            ->withCount('vehicles');

        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%')
                ->orWhereHas('featureCat', function ($query) use ($request) {
                    $query->where('name', 'ILIKE', '%' . $request->search . '%');
                });
        });

        $features = $query
            ->orderBy('name', 'asc')
            ->paginate(15);

        return response()->json([
            'features' => $features
        ], 200);
    }

    public function storeFeature(StoreFeatureRequest $request)
    {
        Feature::create($request->validated());

        return response()->json([
            'message' => 'Feature added successfully'
        ], 201);
    }

    public function updateFeature(
        UpdateFeatureRequest $request,
        Feature $feature
    ) {
        $feature->update($request->validated());

        return response()->json([
            'message' => 'Feature updated successfully'
        ], 200);
    }

    public function deleteFeature(Feature $feature)
    {
        if ($feature->vehicles()->exists()) {
            return response()->json([
                'message' => 'Cannot delete this feature because it is in use by vehicles'
            ], 409);
        }

        $feature->delete();

        return response()->json([
            'message' => 'Feature deleted successfully'
        ], 200);
    }
}
