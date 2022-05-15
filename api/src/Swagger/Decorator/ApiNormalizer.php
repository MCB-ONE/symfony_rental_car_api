<?php

declare(strict_types=1);

namespace App\Swagger\Decorator;

use App\Entity\Model;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ApiNormalizer implements NormalizerInterface, DenormalizerInterface, SerializerAwareInterface{
    private NormalizerInterface $decorated;
    private string $mediaPath;

    public function __construct(NormalizerInterface $decorated, string $mediaPath)
    {
        if (!$decorated instanceof DenormalizerInterface) {
            throw new \InvalidArgumentException(sprintf('The decorated normalizer must implement the %s.', DenormalizerInterface::class));
        }

        $this->decorated = $decorated;
        $this->mediaPath = $mediaPath;
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $this->decorated->supportsNormalization($data, $format);
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        if($object instanceof Model){
            $data = $this->decorated->normalize($object, $format, $context);
            if(null !== $image = $object->getImage()){
                $data['image'] = 'https://rental-car-api.s3.eu-west-3.amazonaws.com/'.$image;
            }

            return $data;
        }
        

        return $this->decorated->normalize($object, $format, $context);
    }

    public function supportsDenormalization($data, $type, string $format = null)
    {
        return $this->decorated->supportsDenormalization($data, $type, $format);
    }

    public function denormalize($data, $class, string $format = null, array $context = [])
    {
        return $this->decorated->denormalize($data, $class, $format, $context);
    }

    public function setSerializer(SerializerInterface $serializer)
    {
        if($this->decorated instanceof SerializerAwareInterface) {
            $this->decorated->setSerializer($serializer);
        }
    }
}